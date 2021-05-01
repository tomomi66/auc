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
            $articles = Car::where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $cars = Car::all();
        }
        $title = "車両一覧";
        return view("cars.index", ['car' => $cars, 'title' => $title]);
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
        $header = mb_convert_encoding($csv -> getHeader(), "UTF8", "auto");
        $header_title = [ $header[6].$header[5], $header[0], $header[14], $header[13], $header[17], $header[19] ];
        $csv_datas = $stmt->process($csv);
        $data = [];

        foreach ($csv_datas as $csv_data) {
            $data[] = mb_convert_encoding($csv_data, "UTF8", "auto");
        }

        $request->session()->put("form_input", [$header, $header_title, $data]);

        if (!$request->session()) {
            return redirect()->action("CarController@create");
        }

        return redirect()->action("CarController@confirm");
        
    }

    public function confirm(Request $request)
    {
        $title = "登録CSV確認ページ";

        $input = $request->session()->get("form_input");
        if (isset($input)) {
            return view("cars.confirm", [ 'title' => $title, 'input' => $input]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
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

    public function importCSV(){
        //
    }
}
