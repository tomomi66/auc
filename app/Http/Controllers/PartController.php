<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Car;
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

//パーツ登録画面(create)からPOSTしてきてComfirmに渡す
    public function post(Request $request)
    {
        dd($request->images);
    }


//パーツ登録画面(create)からPOSTしてきてComfirmに渡してからstoreに行って登録
    public function comfirm(Request $request)
    {
        //
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
        //
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
