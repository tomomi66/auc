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
Route::post('car/statusEnd', 'CarController@statusEnd');

//パーツ情報
Route::get('parts','PartController@index')->name('parts.index'); //パーツ一覧
Route::post('parts/post','PartController@post')->name('parts.post'); //パーツ一覧
Route::get('parts/create/{id}','PartController@create')->name('parts.create'); //ID取得できる形で作成
Route::post('parts/store', 'PartController@store')->name('parts.store'); //取り込み遷移
Route::get('parts/confirm', 'PartController@confirm')->name('parts.confirm'); //確認画面
Route::get('parts/{id}', 'PartController@show')->name('parts.show'); //パーツ詳細画面

//オークション情報
Route::get('auction/{status}','AuctionController@index')->name('auction.index'); //オークション一覧
Route::post('auction/post','AuctionController@post')->name('auction.post'); //オークション一覧
Route::get('auction/create/{id}','AuctionController@create')->name('auction.create'); //ID取得できる形で作成
Route::post('auction/store', 'AuctionController@store')->name('auction.store'); //取り込み遷移
Route::get('auction/confirm', 'AuctionController@confirm')->name('auction.confirm'); //確認画面
Route::get('auction/{id}', 'AuctionController@show')->name('auction.show'); //オークション詳細画面


// 設定画面
Route::get('/setting', function () {
    return view('setting/top', ['title' => "ヤフオク登録"]);
})->name('setting.top');
Route::get('setting/detail', 'SettingController@index')->name('setting.detail');
Route::get('setting/edit', 'SettingController@edit')->name('setting.edit');
Route::post('setting/update', 'SettingController@update')->name('setting.update');

// カテゴリ検索
Route::get('category/search', 'CategoryController@search')->name('category.search');


// Route::get('test', 'TestController@index'); //テスト
// Route::post('test/confirm', 'TestController@confirm')->name('test.confirm'); //取り込み遷移
