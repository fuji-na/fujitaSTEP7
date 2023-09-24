<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//商品情報一覧画面
Route::get('/ichiran', [App\Http\Controllers\ProductController::class, 'ichiran'])->name('ichiran');

//検索
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');

//削除
Route::delete('/post.destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('post.destroy');


//商品情報詳細画面
Route::get('/syousai/{id}', [App\Http\Controllers\ProductController::class, 'syousai'])->name('syousai');

//商品情報登録画面
Route::get('/touroku', [App\Http\Controllers\ProductController::class, 'touroku'])->name('touroku');
Route::post('/registSubmit', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('registSubmit');

//商品情報編集画面
Route::get('/hensyu/{id}', [App\Http\Controllers\ProductController::class, 'hensyu'])->name('hensyu');
//更新
Route::put('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
