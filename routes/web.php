<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/data', [ProductController::class, 'data'])->name('admin.product.data');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.product.show');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::delete('/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
});