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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// 商品情報画面のルーティング
Route::get('/list', 'ProductController@showList')->name('list');

// 新規登録のルーティング
Route::get('/create', 'ProductController@showCreate')->name('create');

// 登録のルーティング
Route::post('/create/store', 'ProductController@exeStore')->name('store');

// 検索機能のルーティング
Route::post('/search', 'ProductController@Search')->name('search');

// 画像登録のルーティング
Route::post('/upload/create', 'ProductController@Upload')->name('upload');

//詳細画面を表示ルーティング
Route::get('/detail/{id}', 'ProductController@showDetail')->name('detail');

// 編集画面
Route::get('details/edit/{id}', 'ProductController@showEdit')->name('edit');

//編集画面アップデート
Route::post('/edit/update', 'ProductController@exeUpdate')->name('update');

// 削除ボタンのルーティング
Route::post('/list/delete/{id}', 'ProductController@exeDelete')->name('delete');