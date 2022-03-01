<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Car;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $parts = Part::where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $parts = Part::where('status', 0)
                ->orderBy('car_id', 'asc')
                ->orderBy('id', 'asc')
                ->paginate(15);
        }
        $title = "パーツ一覧";

        return view('parts/index', ['title' => $title, 'parts' => $parts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $car = Car::find($id);
        $partsCount = DB::table('parts')->where('car_id', $id)->count();
        $parts = [];
        if ($partsCount > 0) {
            $parts = DB::table('parts')->select('parts_name')->where('car_id', $id)->distinct()->get();
        }
        $carModels = $car->model_type;
        if (preg_match('/^([0-9A-Z]*)-([0-9A-Z]*$)/', $carModels, $m)) {
            $carModels = $m[2];
        }

        $title = "パーツ登録◆対象車両：" . $car->name;
        return view('parts/create', ['title' => $title, 'car' => $car, 'partCount' => $partsCount, 'parts' => $parts, 'id' => $id, 'carModels' => $carModels]);
    }

    //パーツ登録画面(create)からPOSTしてきてConfirmに渡す
    public function post(Request $request)
    {

        // バリデーション
        $request->validate([
            'storage_no' => 'required',
            'parts_name' => 'required',
            'category' => 'required',
            'title' => 'bail|required|max:65',
            'shipping' => 'required',
            'finishDay' => 'numeric|between:2,7',
            'finishHour' => 'numeric|between:0,23',
            'starting_price' => 'required|numeric',
            'pompt_decision' => 'nullable|numeric',
            'images.*' => 'required|image'
        ]);

        $requestData = $request->all();
        $carId = $requestData['id'];

        $storageNo = $requestData['storage_no'];
        $partsName = $requestData['parts_name'];
        $partsMaker = $requestData['parts_makers'];
        $partsMakerNo = $requestData['parts_makers_no'];
        $category = $requestData['category'];
        $title = $requestData['title'];
        $tireWheel = $requestData['tire_wheel'];
        $condition = $requestData['condition'];
        $opStatus = $requestData['operating_status'];
        $url = $requestData['video_url'];
        $shipping = $requestData['shipping'];
        $startPrice = $requestData['starting_price'];
        $pompDecision = $requestData['pompt_decision'];
        $finishDay = $requestData['finishDay'];
        $finishHour = $requestData['finishHour'];
        $memo = $requestData['memo'];
        $images = $request->file('images');
        $car = Car::find($carId);
        $date = date('Ymd-His');
        $fileNames = [];
        foreach ($images as $key => $image) {
            if ($key == 10) {
                break;
            }
            $key++;
            $fileName = $carId . '-' . $storageNo . '_' . $date . '-' . sprintf('%02d', $key) . '.jpg';
            if (!$image->storeAs('public/temp', $fileName)) {
                print_r('失敗');
            } else {
                print_r('seikou');
                $fileNames[] = $fileName;
            }
        }

        $inputData = [
            'carId' => $carId,
            'storageNo' => $storageNo,
            'partsName' => $partsName,
            'partMaker' => $partsMaker,
            'partsMakerNo' => $partsMakerNo,
            'category' => $category,
            'tireWheel' => $tireWheel,
            'titleName' => $title,
            'condition' => $condition,
            'opStatus' => $opStatus,
            'url' => $url,
            'shipping' => $shipping,
            'startPrice' => $startPrice,
            'pompDecision' => $pompDecision,
            'memo' => $memo,
            'fileNames' => $fileNames,
            'finishDay' => $finishDay,
            'finishHour' => $finishHour
        ];

        $request->session()->put('inputData', $inputData);

        return redirect()->action('PartController@confirm');
    }


    //パーツ登録画面(create)からPOSTしてきてConfirmに渡してからstoreに行って登録
    public function confirm(Request $request)
    {
        $inputData = $request->session()->get('inputData');

        $car = Car::find($inputData['carId']);
        // 値を受け取ってviewに渡す
        $title = 'パーツ登録内容確認';
        return view('parts.confirm', ['title' => $title, 'inputData' => $inputData, 'car' => $car]);
    }




    /**
     * Confirme a newly created resource in storage.

     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 値を受け取る
        $inputData = $request->session()->get('inputData');

        $saveParts = new Part;  // 保存用にpartモデルをnew

        // コピー元のパス取得  D:\xampp\htdocs\auc_okano\storage\app\public\temp
        $copyFrom = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR);

        // 保存先パスの取得
        $copyTo = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'save' . DIRECTORY_SEPARATOR);

        // 画像を正規の場所にコピーremove
        foreach ($inputData['fileNames'] as $key => $files) {
            if (copy($copyFrom . $files,  $copyTo . $files)) {
                // @unlink($copyFrom . $files);
                $key++;
                $saveParts->{'image' . $key} = $files;
            }
        }
        // partsテーブルの画像のリンクを正規のところに書き換え

        // tire wheel をカンマ区切りに変換
        if (count(array_filter($inputData['tireWheel']['tire'])) > 0) {
            $tire = implode(",", $inputData['tireWheel']['tire']);
        } else {
            $tire = null;
        }
        if (count(array_filter($inputData['tireWheel']['wheel'])) > 0) {
            $wheel = implode(",", $inputData['tireWheel']['wheel']);
        } else {
            $wheel = null;
        }

        // カテゴリをIDだけにする
        $category = explode(':', $inputData['category']);
        // DBに登録

        $saveParts->car_id = $inputData['carId'];
        $saveParts->parts_name = $inputData['partsName'];
        $saveParts->parts_makers = $inputData['partMaker'];
        $saveParts->parts_makers_no = $inputData['partsMakerNo'];
        $saveParts->title = $inputData['titleName'];
        $saveParts->condition = $inputData['condition'];
        $saveParts->video_url = $inputData['url'];
        $saveParts->postage_class = $inputData['shipping'];
        $saveParts->starting_price = $inputData['startPrice'];
        $saveParts->pompt_decision = $inputData['pompDecision'];

        $saveParts->memo = $inputData['memo'];

        $saveParts->storage_no = $inputData['storageNo'];
        $saveParts->tires = $tire;
        $saveParts->wheels = $wheel;
        $saveParts->finish_day = $inputData['finishDay'];
        $saveParts->finish_hour = $inputData['finishHour'];

        $saveParts->category = $category[1];

        $saveParts->save();
        //saveした後のidを取得する 
        return redirect()->action('PartController@show', ['id' => $saveParts->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parts = DB::table('parts')->join('cars', 'parts.car_id', '=', 'cars.id')
            ->join('categories', 'parts.category', '=', 'categories.number')
            ->select('parts.*', 'cars.name as car_name', 'cars.record_number as record_number', 'categories.category_name')
            ->where('parts.id', $id)->first();

        $title = 'パーツ詳細:' . $parts->car_name . '　' . $parts->parts_name;
        $fileNames = [];

        for ($i = 1; $i <= 10; $i++) {
            if ($parts->{'image' . $i} != "") {
                $fileNames[] = $parts->{'image' . $i};
            }
        }
        $wheel = explode(',', $parts->wheels);
        $tire = explode(',', $parts->tires);

        return view('parts.show', ['title' => $title, 'parts' => $parts, 'fileNames' => $fileNames, 'tire' => $tire, 'wheel' => $wheel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        //
    }
}
