<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Car;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $parts = Part::paginate(15);
        }
        $title = "パーツ一覧";

        return view('parts/index', ['title'=> $title, 'parts' => $parts]);
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
        if( $partsCount > 0){
            $parts = DB::table('parts')->select('parts_name')->where('car_id', $id)->distinct()->get();
        }


        $title = "パーツ登録◆対象車両：".$car->name;
        return view('parts/create', ['title'=> $title, 'car' => $car, 'partCount' => $partsCount, 'parts' => $parts, 'id' => $id]);
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
            'starting_price'=> 'required|numeric',
            'pompt_decision'=> 'required|numeric',
            'images.*' => 'required|image'
        ]);
        
        $requestData = $request->all();
        $carId = $requestData['id'];
        var_dump($requestData);
        $storageNo = $requestData['storage_no'];
        $partsName = $requestData['parts_name'];
        $partsMaker = $requestData['parts_makers'];
        $partsMakerNo = $requestData['parts_makers_no'];
        $category = $requestData['category'];
        $title = $requestData['title'];
        $condition = $requestData['condition'];
        $opStatus = $requestData['operating_status'];
        $url = $requestData['video_url'];
        $shipping = $requestData['shipping'];
        $startPrice = $requestData['starting_price'];
        $pompDecision = $requestData['pompt_decision'];
        $memo = $requestData['memo'];
        $images = $request->file('images');
        $car = Car::find($carId);
        $fileNames = [];
        foreach($images as $key => $image){
            $fileName = $carId.'-'.$storageNo.'_'.$partsName.'-'.$key.'.jpg';
            if(!$image->storeAs('public/temp', $fileName)){
                print_r('失敗');
            }else{
                print_r('seikou');
                $fileNames[] = $fileName;
            }
        }

        $inputData = [
            'carId' => $carId,
            'storageNo' => $storageNo,
            'partsName' => $partsName,
            'partsMakerNo' => $partsMakerNo,
            'category' => $category,
            'titleName' => $title,
            'condition' => $condition,
            'opStatus' => $opStatus,
            'url' => $url,
            'shipping' => $shipping,
            'startPrice' => $startPrice,
            'pompDecision' => $pompDecision,
            'memo' => $memo,
            'fileNames' => $fileNames
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
        // 値を受け取って登録


        // 画像を正規の場所にコピーremove

        // partsテーブルの画像のリンクを正規のところに書き換え
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part, $id)
    {
        //
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
