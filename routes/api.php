<?php

use Illuminate\Http\Request;

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
Route::post('register', ['uses' => 'Auth\LoginController@apiRegister']);
Route::post('login', ['uses' => 'Auth\LoginController@apiCheckLogin']);


Route::group(['middleware' => 'api'], function ($router) {
    Route::post('logout', ['uses' => 'Auth\LoginController@apiLogout']);
    Route::post('user', ['uses' => 'Auth\LoginController@getAuthUser']);
});
