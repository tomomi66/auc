<?php

namespace App\Http\Controllers;

use App\Car;
use App\Part;
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
            $cars = Car::where('name', 'like', '%' . $keyword . '%')->paginate(15);
        } elseif ($request->filled('record_no')) {
            $record_no = $request->input('record_no');
            $cars = Car::where('record_number', 'like', '%' . $record_no . '%')->paginate(15);
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
        $header_title = [ $header[2], $header[11], $header[21], $header[23], $header[24], $header[28], $header[33], $header[35], $header[36], $header[45], $header[49] ];
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
            
            $insert_data['name'] = $data['車名'];            
            $insert_data['status'] = 0;
            $insert_data['model_type'] = $data['認定型式'];

            if( $data['グレード'] == "" ){
                $insert_data['model_grade'] = 'なし';   
            } else {
                $insert_data['model_grade'] =  mb_convert_kana($data['グレード'], 'KV');
            }

            if( $data['車体カラー'] == "" ){
                $insert_data['color'] = '不明';   
            } else {
                $insert_data['color'] = mb_convert_kana($data['車体カラー'], 'KV');   
            }
            
            if( $data['カラーNo'] == "" ){
                $insert_data['color_no'] = 0;   
            } else {
                $insert_data['color_no'] = $data['カラーNo'];
            }

            if( $data['トリムNo'] == "" ){
                $insert_data['trim_no'] = 0;   
            } else {
                $insert_data['trim_no'] = $data['トリムNo'];
            }
            
            if( $data['走行距離'] == ""){
                $insert_data['mileage'] = 9999999;
            } else {
                $insert_data['mileage'] = $data['走行距離'];
            }
            
            $insert_data['create_parson'] = "テスト";
            $insert_data['chenge_person'] = "テスト";
            $insert_data['created_at'] = now();
            $insert_data['updated_at'] = now();
            $insert_data['record_number'] = $data['カルテ番号'];            
            $insert_data['made_year'] = $data['年式:年'];

            if( $data['年式:月'] == ""){
                $insert_data['made_month'] = 0;
            } else {
                $insert_data['made_month'] = $data['年式:月'];
            }
            
            
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
        $car = Car::find($id);
        $title = "車両：".$car->name;

        return view('cars.show', ['title' => $title, 'car' => $car]);
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
    public function update(Request $request, Car $car, $id)
    {
        //  編集データの更新
        $car = Car::find($id);
        $car->model_grade = request('model_grade');
        $car->color = request('color');
        $car->color_no = request('color_no');
        $car->trim_no = request('trim_no');
        $car->mileage = request('mileage');
        $car->chenge_person = "変更者";
        $car->updated_at = now();
        $car->save();

        $title = "車両：".$car->name;
        return redirect()->action('CarController@show', ['title' => $title, 'car' => $car, 'id' => $id ]);
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
