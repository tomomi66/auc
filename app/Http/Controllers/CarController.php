<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
//CSV用
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\CharsetConverter;
use League\Csv\Statement;
use App\Http\Controllers\Controller;

use Validator;
class CarController extends Controller
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
            $cars = Car::where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $cars = Car::paginate(15);
        }
        $title = "車両一覧";
        return view("cars.index", ['cars' => $cars, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $title = "車両一括登録";


        return view("cars.create", ['title' => $title]);
    }


    public function post(Request $request, Statement $stmt, Car $car)
    {
        $file_path = $request->file('csvfile')->getPathname();
        $csv = Reader::createFromPath($file_path, 'r')->setHeaderOffset(0);
        $header = mb_convert_encoding($csv -> getHeader(), "UTF-8", "SJIS");
        $header_title = [ $header[6].$header[5], $header[0], $header[14], $header[13], $header[17], $header[19] ];
        $csv_datas = $stmt->process($csv);
        $data = [];

        foreach ($csv_datas as $csv_data) {
            $data[] = mb_convert_encoding($csv_data, "UTF-8", "SJIS");
        }

        $request->session()->put("form_input", [$data]);
        $request->session()->put("header", [$header_title]);


        if (!$request->session()) {
            return redirect()->action("CarController@create");
        }

        return redirect()->action("CarController@confirm");
        
    }

    public function confirm(Request $request)
    {
        $title = "登録CSV確認ページ";

        $input = $request->session()->get("form_input");
        $header =  $request->session()->get("header");
        

        if (isset($input) && isset($header)) {
            //return view("cars.confirm", [ 'title' => $title, 'input' => $input]);
            return view("cars.confirm", [ 'title' => $title, 'input' => $input, 'header' => $header ]);
        } else {
            return view("cars.create");
        }

        return redirect()->action("CarController@create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Car  $car
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Car $car)
    {
        //データベースに追加する
        $inputs = $request->session()->get("form_input");
        $insert_data = [];

        foreach( $inputs[0] as $data ){
            $insert_data['name'] = $data['メーカー'].$data['車名'];
            $insert_data['in_number'] = $data['入庫番号'];
            $insert_data['status'] = 0;
            $insert_data['registration_volume'] = 0;
            $insert_data['made_date'] = $data['年式'];
            $insert_data['model_type'] = $data['認定型式'];
            $insert_data['model_grade'] = "なし";
            $insert_data['color'] = mb_convert_kana($data['外装色'], 'KV');
            $insert_data['color_no'] = 0;
            $insert_data['trim_no'] = 0;
            $insert_data['mileage'] = $data['走行距離'];
            $insert_data['create_parson'] = "テスト";
            $insert_data['chenge_person'] = "テスト";
            $insert_data['created_at'] = now();
            $insert_data['updated_at'] = now();

            
            $car->insert($insert_data);
        }


        return redirect()->action("CarController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Car::find($id);
        $title = "車両：".$data->name;

        return view('cars.show', ['title' => $title, "data" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car, $id)
    {
        //編集画面
        $car = Car::find($id);
        $title = '車両編集画面：'.$car->name;

        return view('cars.edit', ['car' => $car, 'title'=> $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car, Id $id)
    {
        //  編集データの更新      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }

}
