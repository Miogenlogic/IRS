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
// Route::post('register', ['uses' => 'Auth\LoginController@apiRegister']);
// Route::post('login', ['uses' => 'Auth\LoginController@apiCheckLogin']);


// Route::group(['middleware' => 'api'], function ($router) {
//     Route::post('logout', ['uses' => 'Auth\LoginController@apiLogout']);
//     Route::post('user', ['uses' => 'Auth\LoginController@getAuthUser']);
// });
 Route::group(['namespace' => 'Api','middleware' => 'auth:api'], function(){


Route::get('/admin-information', ['uses' => 'ApiController@information']);
Route::post('/admin-informationedit', ['uses' => 'ApiController@informationedit']);
Route::post('/admin-incident', ['uses' => 'ApiController@incident']);
//Route::post('/admin-myhealthedit', ['uses' => 'DashboardController@myhealthedit']);

	Route::post('/changeDateRange', ['uses' => 'ApiController@changeDateRange']);

 
});


//Route::get('/admin-information', ['uses' => 'Api\ApiController@information']);

Route::post('/login', ['uses' => 'Api\ApiController@login']);
//Route::post('/loginchk', [ 'uses' => 'Api\ApiController@checklogin']);
 
   Route::get('/logout', ['uses' => 'Api\ApiController@logout']);
 	
//Route::get('/logout', ['uses' => 'Api\ApiController@logout']);
Route::get('/forgotpass', ['uses' => 'Api\ApiController@forgotPassword']);

Route::post('/forgot', ['uses' => 'Api\ApiController@forget']);
Route::get('/reset', ['uses' => 'Api\ApiController@reset']);


//Route::post('/login', ['uses' => 'Api\ApiController@login']);
//Route::post('/loginchk', [ 'uses' => 'Api\ApiController@checklogin']);

//Route::get('/logout', ['uses' => 'Api\ApiController@logout']);
//Route::get('/forgotpass', ['uses' => 'Api\ApiController@forgotPassword']);

//Route::post('/forgot', ['uses' => 'Api\ApiController@forget']);
//Route::get('/reset', ['uses' => 'Api\ApiController@reset']);
