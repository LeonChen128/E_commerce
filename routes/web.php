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
    Route::get('info/{id}', 'ProductController@info');
});

Route::prefix('api')->middleware('web')->namespace('API')->group(function() {

    Route::prefix('product')->group(function() {
        Route::get('', 'ProductController@index');
    });

    Route::prefix('auth')->group(function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::get('check', 'AuthController@check');
        Route::post('register-check', 'AuthController@registerCheck');
        Route::post('create', 'AuthController@create');
    });
});

