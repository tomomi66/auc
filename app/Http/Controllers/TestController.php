<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test',['title' => 'テスト']);
    }

    public function confirm(Request $request)
    {
        $testArea = $request->input('testArea');
        var_dump($testArea);
        return view('test2', ['title' => '内容確認', 'testArea' => $testArea]);
    }
}
