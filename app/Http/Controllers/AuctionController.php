<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Part;
use App\Models\Setting;

use Illuminate\Http\Request;
use App\Consts\YahuokuConsts;
use App\Consts\CsvDataConsts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{
    /** wheel const */
    const WHEEL_SIZE1 = 0;
    const WHEEL_SIZE2 = 1;
    const WHEEL_OFF = 2;
    const WHEEL_PCD = 3;
    const WHEEL_HOLE = 4;
    const WHEEL_HUB = 5;
    const WHEEL_HUBC = 6;
    const WHEEL_MATE = 7;
    /** tire const */
    const TIRE_SIZE1 = 0;
    const TIRE_SIZE2 = 1;
    const TIRE_SIZE3 = 2;
    const TIRE_COUNT = 3;
    const TIRE_YEAR = 4;
    const TIRE_MAKER = 5;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        // ページタイトル設定
        if ($status == 0) {
            $title = "出力前オークション情報一覧";
        } elseif ($status == 9) {
            $title = "出力済みオークション情報一覧";
        } elseif ($status == 5) {
            $title = "【エラー】オークション情報一覧";
        } else {
            $title = "オークション情報一覧";
        }

        // オークション情報取得
        if (DB::table('auctions')->where('status', $status)->exists()) {
            $aucData = DB::table('auctions')
                ->join('parts', 'auctions.parts_id', '=', 'parts.id')
                ->join('cars', 'parts.car_id', '=', 'cars.id')
                ->select('auctions.id', 'parts.parts_name as parts_name', 'cars.name as car_name','cars.record_number as number')
                ->where('auctions.status', $status)
                ->orderBy('auctions.updated_at', 'asc')
                ->paginate(15);
            return view('auction/index', ['title' => $title, 'aucData' => $aucData, 'status' => $status, 'message' => null]);
        } else {
            return view('auction/index', ['title' => $title, 'aucData' => null,'status' => null, 'message' => null]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $title = 'オークション商品登録';
        $parts = DB::table('parts')->join('cars', 'parts.car_id', '=', 'cars.id')
            ->join('categories', 'parts.category', '=', 'categories.number')
            ->select('parts.*', 'cars.*', 'categories.category_name')
            ->where('parts.id', $id)->first();
        $settings = DB::table('settings')->first();

        for ($i = 1; $i <= 10; $i++) {
            if ($parts->{'image' . $i} != "") {
                $fileNames[] = $parts->{'image' . $i};
            }
        }
        $wheel = explode(',', $parts->wheels);
        $tire = explode(',', $parts->tires);

        // 商品説明を作る
        // title作成
        $memoTitle = sprintf(config('auction.AUCTION_TITLE'), $parts->title);
        // 商品テンプレート選択
        $discript = '';
        if (count(array_filter($wheel)) > 0) {
            $discript = config('auction.WHEEL_BEFORE');
            $discript .= sprintf(
                config('auction.WHEEL_DISCRIPT'),
                $wheel[self::WHEEL_SIZE1],
                $wheel[self::WHEEL_SIZE2],
                $wheel[self::WHEEL_OFF],
                $wheel[self::WHEEL_PCD],
                $wheel[self::WHEEL_HOLE],
                $wheel[self::WHEEL_HUB],
                $wheel[self::WHEEL_HUBC],
                $wheel[self::WHEEL_MATE],
                $parts->parts_makers,
            );

            if (count(array_filter($tire)) > 0) {
                $discript .= sprintf(
                    config('auction.TIRE_DISCRIPT'),
                    $tire[self::TIRE_SIZE1],
                    $tire[self::TIRE_SIZE2],
                    $tire[self::TIRE_SIZE3],
                    $tire[self::TIRE_COUNT],
                    $tire[self::TIRE_MAKER],
                    $tire[self::TIRE_YEAR],
                );
            }
            $discript .= config('auction.WHEEl_END');
        } else {
            $discript = sprintf(
                config('auction.PART_DISCRIPT'),
                $parts->made_year,
                $parts->made_month,
                $parts->name,
                $parts->model_type,
                $parts->model_grade,
                $parts->color_no,
                $parts->trim_no,
                $parts->mileage
            );
        }

        $shipType = \YahuokuConst::SHIP_GROUP[$parts->postage_class];
        $shipping = sprintf(config('auction.AUCTION_SHIP_GROUP'), $shipType);
        if ($parts->postage_class == 8) {
            $shipping .= config('auction.SHIP_NEKOPOS');
        } elseif ($parts->postage_class > 2 && $parts->postage_class < 8) {
            $shipping .= config('auction.SHIP_TEMPLATE');
        }

        $memo = $memoTitle;
        $memo .= $discript;
        $memo .= '<div style="margin: 8px 0; padding: 8px 0;">' . $parts->memo . '</div>';
        $memo .= $settings->comment1;
        $memo .= $shipping;
        $memo .= $settings->comment3;


        // オークション用データ
        $aucData = [
            'fileNames' => $fileNames,
            'memo' => $memo,
        ];

        return view('auction/create', ['id' => $id, 'title' => $title, 'aucData' => $aucData, 'parts' => $parts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // requestでのデータを受け取る
        $inputs = $request->all();
        $id = $inputs['id'];
        $discript = $inputs['discript'];
        $discript = str_replace(array("\r\n", "\r", "\n"), '', $discript);

        $parts = DB::table('parts')->join('cars', 'parts.car_id', '=', 'cars.id')
            ->join('categories', 'parts.category', '=', 'categories.number')
            ->select('parts.*', 'cars.*', 'categories.category_name')
            ->where('parts.id', $id)->first();

        // オークションモデルをnew
        $auction = new Auction;

        // 各データを入れる
        $auction->parts_id = $id;
        $auction->category = $parts->category;
        $auction->title = $parts->title;
        $auction->descript = $discript;
        $auction->starting_price = $parts->starting_price;
        $auction->pompt_decision = $parts->pompt_decision;
        $auction->term = (int)$parts->finish_day;
        $auction->end_time = (int)$parts->finish_hour;
        $auction->shipping_group = $parts->postage_class;
        $auction->condition = $parts->condition;
        $auction->image1 = $parts->image1;
        $auction->image2 = $parts->image2;
        $auction->image3 = $parts->image3;
        $auction->image4 = $parts->image4;
        $auction->image5 = $parts->image5;
        $auction->image6 = $parts->image6;
        $auction->image7 = $parts->image7;
        $auction->image8 = $parts->image8;
        $auction->image9 = $parts->image9;
        $auction->image10 = $parts->image10;
        $auction->save();

        if($auction->save()){
            $updateParts = Part::find($id);
            $updateParts->status = 9;
            $updateParts->save();
        }

        return redirect()->route('auction.index', ['status' => 0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'ID:'.$id.'オークション詳細';

        $auction = DB::table('auctions')->join('categories', 'auctions.category', '=', 'categories.number')
        ->select('auctions.*', 'categories.category_name')
        ->where('auctions.id', $id)->first();
// var_dump($auction);
// var_dump($title);
        for ($i = 1; $i <= 10; $i++) {
            if ($auction->{'image' . $i} != "") {
                $fileNames[] = $auction->{'image' . $i};
            }
        }
        return view('auction/show', ['id' => $id, 'title' => $title, 'auction' => $auction, 'fileNames' => $fileNames]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }


    /**
     * CSV出力
     *
     * @param  $request
     * @return bool
     */
    public function putcsv(Request $request)
    {
        $inputs = $request->all();
        
        if(isset($inputs['output'])){
            $selectId = $inputs['output'];
        }else{
            // 空でCSV出力ボタンを押したときオークション一覧にリダイレクト
            return redirect()->route('auction.index', ['status' => 0]);
        }

        $aucData = DB::table('auctions')->whereIn('id', $selectId)->get();
        $setting = DB::table('settings')->first();
        $date = date('Ymd-His');
        $tempFolder = 'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'auction'.DIRECTORY_SEPARATOR;
        $storageFolder = 'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
        Storage::makeDirectory('public'.DIRECTORY_SEPARATOR.'auction'.DIRECTORY_SEPARATOR.$date);
        $path = storage_path($tempFolder.$date);
        $csvFile = $path.DIRECTORY_SEPARATOR.date('Ymd').'_auction.csv';

        $copyfrom = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'save'.DIRECTORY_SEPARATOR);
        $i = 0;
        foreach($aucData as $data){
            $csvData[] = CsvDataConsts::CSV_DATA;

            //csvのデータ挿入
            $csvData[$i][CsvDataConsts::MANAGE_NUMBER] = $data->id;    // 管理番号
            $csvData[$i][CsvDataConsts::CATEGORY] = $data->category;    // カテゴリ
            $csvData[$i][CsvDataConsts::TITLE] = $data->title;    // タイトル
            $csvData[$i][CsvDataConsts::DISCRIPTION] = $data->descript;    // 説明
            $csvData[$i][CsvDataConsts::START_PRICE] = $data->starting_price;    // 開始価格
            $csvData[$i][CsvDataConsts::IMMEDIATE_PRICE] = $data->pompt_decision;    // 即決価格
            $csvData[$i][CsvDataConsts::COUNT] = '1';    // 個数
            $csvData[$i][CsvDataConsts::SPAN] = $data->term;    // 期間
            $csvData[$i][CsvDataConsts::END_TIME] = $data->end_time;    // 終了時間
            $csvData[$i][CsvDataConsts::PRODUCT_STATUS] = $data->condition;    // 商品の状態
            $csvData[$i][CsvDataConsts::IMAGE1] = $data->image1;    // 画像1
            $csvData[$i][CsvDataConsts::IMAGE2] = $data->image2;    // 画像2
            $csvData[$i][CsvDataConsts::IMAGE3] = $data->image3;    // 画像3
            $csvData[$i][CsvDataConsts::IMAGE4] = $data->image4;    // 画像4
            $csvData[$i][CsvDataConsts::IMAGE5] = $data->image5;    // 画像5
            $csvData[$i][CsvDataConsts::IMAGE6] = $data->image6;    // 画像6
            $csvData[$i][CsvDataConsts::IMAGE7] = $data->image7;    // 画像7
            $csvData[$i][CsvDataConsts::IMAGE8] = $data->image8;    // 画像8
            $csvData[$i][CsvDataConsts::IMAGE9] = $data->image9;    // 画像9
            $csvData[$i][CsvDataConsts::IMAGE10] = $data->image10;    // 画像10
            $csvData[$i][CsvDataConsts::LOWEST_RATE] = $setting->min_rate;    // 最低評価
            $csvData[$i][CsvDataConsts::WORTH_LIMIT] = 'はい';    // 悪評割合制限
            $csvData[$i][CsvDataConsts::AUTH_LIMIT] = $setting->evil_rate_limit;    // 入札者認証制限
            $csvData[$i][CsvDataConsts::AUTO_EXTENDED] = $setting->authen_limit;    // 自動延長
            $csvData[$i][CsvDataConsts::AUTO_RELISTING] = $setting->auto_extend;    // 商品の自動再出品
            $csvData[$i][CsvDataConsts::TAX_SETTING] = $setting->tax_preference;    // 消費税設定
            $csvData[$i][CsvDataConsts::INTAX_FLUG] = 'はい';    // 税込みフラグ
            $csvData[$i][CsvDataConsts::ITEM_SHIPPING_GROUP] = $data->shipping_group;    // 配送グループ
        
            //画像をコピー
            for ($i = 1; $i <= 10; $i++) {
                if ($data->{'image' . $i} != "") {
                    $fileName = $data->{'image' . $i};

                    if(copy( $copyfrom.$fileName,  $path.DIRECTORY_SEPARATOR.$fileName)){
                        // @unlink($copyfrom.$fileName);
                        
                    }else{
                        $message = 'CSVの出力に失敗しました。';
                        // TODO:作ったフォルダを削除する
                        $this->delFolder($path);
                        $message= 'CSVの作成に失敗しました。';
                        return redirect()->route('auction.index', ['status' => 0, 'message' => $message]);
                    }
                }
            }
            $i++;
        }

        // var_dump($csvData);
        // csv出力
        $res = fopen($csvFile, 'w');
        $header = mb_convert_encoding(YahuokuConsts::CSV_HEADER, 'SJIS');
        fputcsv($res,$header);
        foreach($csvData as $temp){
            $temp = mb_convert_encoding($temp, 'SJIS');
            fputcsv($res,$temp);
        }
        fclose($res);

        // フォルダを圧縮
        $zipFile = $path.'.zip';
        // ZIPフォルダ名（フルパス）で指定
        $csvZip = new \PharData($zipFile);
        if($csvZip->buildFromDirectory($path)){
            // ダウンロード
            header('Content-Type: application/force-download');
            header('Content-Disposition: filename="'.basename($zipFile).'"');
            readfile($zipFile);
            copy($zipFile, $storageFolder.basename($zipFile)); // storageフォルダにzipファイルをコピー
            unlink($zipFile);
            // TODO: 作ったフォルダを削除する
            $this->delFolder($path);
        }else{
            $message= 'CSVの作成に失敗しました。';
            return redirect()->route('auction.index', ['status' => 0, 'message' => $message]);
        }
        
        // auctionのステータスを変更　bulkで行けるはず（$aucData）

    }

    /**
     * フォルダ削除
     * @param string $path 削除するフォルダのフルパス
     * @return bool
     */

    private function delFolder($path)
    {
        //
    }
}
