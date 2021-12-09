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

Route::group(['namespace' => 'Main'], function (){
    Route::get('/', 'IndexController')->name('main.index');
    Route::get('/list', 'ListController')->name('list.index');
    Route::delete('/list', 'DeleteController');
});

Route::group(['namespace' => 'Cart', 'prefix' => 'cart'], function () {
    Route::get('/', 'IndexController')->name('cart.index');
    Route::post('/', 'StoreController');
    Route::delete('/', 'DeleteController');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
