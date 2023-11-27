<?php

use Illuminate\Support\Facades\Route;

Route::get('', [App\Http\Controllers\F2E\ProductController::class, 'index']);

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

Route::middleware('web')->prefix('api')->namespace('API')->group(function() {

    Route::prefix('auth')->group(function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::get('login-check', 'AuthController@loginCheck');
        Route::post('register-check', 'AuthController@registerCheck');
        Route::post('create', 'AuthController@create');
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