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

Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
    Route::post('register', 'Api\Auth\RegisterController@register');
    Route::post('login', 'Api\Auth\LoginController@login');
    Route::post('logout', 'Api\Auth\LoginController@logout')->middleware('auth');
    Route::post('refresh', 'Api\Auth\LoginController@refresh')->middleware(['api']);
    Route::get('me', 'Api\Auth\UserController@show')->middleware(['auth']);
    Route::post('me', 'Api\Auth\UserController@update')->middleware(['auth']);
    Route::post('reset-password', 'Api\Auth\UserController@resetPassword')->middleware(['auth']);
});

Route::group(['middleware' => ['api', 'auth']], function () {
    Route::get('stock-data', 'Api\StockDataController@index');
    Route::post('stock-data', 'Api\StockDataController@store');
    Route::get('stock-data/{id}', 'Api\StockDataController@show');
    Route::put('stock-data/{id}', 'Api\StockDataController@update');
    
    Route::get('forex-data', 'Api\ForexDataController@index');
    Route::post('forex-data', 'Api\ForexDataController@store');
    Route::get('forex-data/{id}', 'Api\ForexDataController@show');
    Route::put('forex-data/{id}', 'Api\ForexDataController@update');

    Route::get('crypto-data', 'Api\CryptoDataController@index');
    Route::post('crypto-data', 'Api\CryptoDataController@store');
    Route::get('crypto-data/{id}', 'Api\CryptoDataController@show');
    Route::put('crypto-data/{id}', 'Api\CryptoDataController@update');
});
