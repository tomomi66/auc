<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top', ['title' => "ヤフオク登録"]);
});
Route::get('car', 'CarController@index')->name('car.index');

//車両情報create
Route::get('car/create', 'CarController@create')->name('car.create'); //CSV取り込み画面
Route::post('car/post', 'CarController@post')->name('car.post'); //取り込み遷移
Route::post('car/store', 'CarController@store')->name('car.store'); //取り込み遷移
Route::get('car/confirm', 'CarController@confirm')->name('car.confirm'); //確認画面
Route::get('car/{id}', 'CarController@show')->name('car.show'); //確認画面
Route::get('car/edit/{id}', 'CarController@edit')->name('car.edit'); //確認画面
Route::post('car/update/{id}', 'CarController@update')->name('car.update'); //編集アップデート

//パーツ情報
Route::get('parts/create/{id}','PartController@create')->name('parts.create'); //ID取得できる形で作成
Route::post('parts/post', 'PartController@post')->name('parts.post'); //取り込み遷移
Route::get('parts/confirm', 'PartController@confirm')->name('parts.confirm'); //確認画面
Route::resource('parts', 'PartController', ['except' => ['create']] ); //create専用Route作成のため除外
//Route::resource('parts', 'PartController' ); //create専用Route作成のため除外
