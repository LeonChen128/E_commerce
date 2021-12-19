<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('web')->namespace('API')->group(function() {

    Route::prefix('auth')->group(function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::get('login-check', 'AuthController@loginCheck');
        Route::post('register-check', 'AuthController@registerCheck');
        Route::post('create', 'AuthController@create');
    });

    Route::prefix('product')->group(function() {
        Route::get('', 'ProductController@index');
    });

    Route::prefix('order')->group(function() {
        Route::post('', 'OrderController@create');
        Route::put('{id}/cancel', 'OrderController@cancel');
    });

    Route::prefix('user')->group(function() {
        Route::post('{id}', 'UserController@updateHead');
        Route::put('{id}', 'UserController@update');
    });
});