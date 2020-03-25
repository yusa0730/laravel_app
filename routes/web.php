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
// GETアクセスのルート情報はRouteクラスの静的メソッドであるgetメソッドを使って設定されている。
// 第一引数に割り当てるアドレス(URL)を、第二引数にそれによって呼び出される処理を用意する。第二引数には関数を指定することもあるし、「コントローラ」を指定することもある。
Route::get('/', function () {
    return view('welcome');
});

// resourceを使ったときのルーティングを制限する方法は2つあります。
// 例1：['only' => ['index', 'create', 'edit', 'store', 'destroy']] onlyで設定したアクションだけ利用する。
// 例2:['except' => ['show', 'update']] exceptで設定したアクション以外を利用する。
Route::resource('todo', 'TodoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
