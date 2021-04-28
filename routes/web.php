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
    return view('welcome');
});

Route::get('car', 'CarController@index')->name('car.index');

//車両情報create
Route::get('car/create', 'CarController@create')->name('car.create');　//CSV選択画面
Route::post('car/post', 'CarControlle@post')->name('car.post'); //選択後遷移先
Route::post('car/confirm', 'CarControlle@confirm')->name('car.confirm'); //確認画面
Route::post('car/csv', "CarController@importCSV")->name('car.importCSV'); //DB登録