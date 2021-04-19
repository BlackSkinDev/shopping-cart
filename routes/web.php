<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/','ProductController@index')->name('index');

Route::get('/product/{product}','ProductController@show')->name('show');
Route::post('/product/{product}','ProductController@addToCart')->name('add');
Route::get('/product','ProductController@cart')->name('cart');
Route::patch('/update', 'ProductController@update')->name('update');
Route::delete('/remove', 'ProductController@remove')->name('remove');


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout','ProductController@checkout')->name('checkout');
    Route::post('/pay', 'ProductController@redirectToGateway')->name('pay');
    Route::get('/callback', 'ProductController@handleGatewayCallback')->name('callback');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('signout');
    Route::get('/order','ProductController@order')->name('order');
});



Route::get('/session','ProductController@session')->name('show');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
