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

Route::prefix('product')->group(function() {
    Route::get('', 'ProductController@index');
    Route::get('detail/{id}', 'ProductController@detail');
});

Route::prefix('cart')->group(function() {
    Route::get('', 'CartController@index');
});

Route::prefix('user')->middleware('auth')->group(function() {
    Route::get('profile', 'UserController@profile');
    Route::get('password', 'UserController@password');
});
