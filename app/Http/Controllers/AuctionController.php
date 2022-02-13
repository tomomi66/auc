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
            $acuData = DB::table('auctions')
                ->join('parts', 'auctions.parts_id', '=', 'parts.id')
                ->join('cars', 'parts.car_id', '=', 'cars.id')
                ->select('auctions.id', 'parts.parts_name as parts_name', 'cars.name as car_name','cars.record_number as number')
                ->where('auctions.status', $status)
                ->orderBy('auctions.updated_at', 'asc')
                ->paginate(15);

            return view('auction/index', ['title' => $title, 'acuData' => $acuData, 'status' => $status]);
        } else {
            return view('auction/index', ['title' => $title, 'acuData' => null]);
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

        $parts = DB::table('parts')->join('cars', 'parts.car_id', '=', 'cars.id')
            ->join('categories', 'parts.category', '=', 'categories.number')
            ->select('parts.*', 'cars.*', 'categories.category_name')
            ->where('parts.id', $id)->first();
var_dump($parts);

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
        // $auction->save();
        return;
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
    public function show(Auction $auction)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
