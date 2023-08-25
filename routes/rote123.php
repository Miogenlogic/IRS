<?php

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





// //Admin
Route::group(['prefix' => 'admin'], function(){
   Route::group(['namespace' => 'Admin','middleware' => 'auth'], function(){

Route::get('/admin-dashboard', ['uses' => 'DashboardController@dashboard']);
Route::get('/admin-incitable', ['uses' => 'DashboardController@incitable']);
Route::get('/admin-closetable', ['uses' => 'DashboardController@closetable']);
Route::get('/admin-opentable', ['uses' => 'DashboardController@opentable']);

Route::get('/admin-reportform', ['uses' => 'DashboardController@reportform']);
Route::post('/admin-reporteditstore', ['uses' => 'DashboardController@reportedit']);

Route::get('/admin-myhealth', ['uses' => 'DashboardController@myhealth']);
Route::post('/admin-myhealthedit', ['uses' => 'DashboardController@myhealthedit']);
Route::get('/admin-incident', ['uses' => 'DashboardController@incident']);
Route::post('/admin-incident_rmcomment', ['uses' => 'DashboardController@rmcomment']);
Route::post('/admin-incident_zacomment', ['uses' => 'DashboardController@zacomment']);
Route::post('/admin-incident_shcomment', ['uses' => 'DashboardController@shcomment']);
Route::post('/admin-incident_ahcomment', ['uses' => 'DashboardController@ahcomment']);
Route::post('/admin-statecity', ['uses' => 'DashboardController@statecity']);
Route::post('/admin-statedis', ['uses' => 'DashboardController@statedis']);
Route::get('/admin-incidentrm-edit/{id}', ['uses' => 'DashboardController@incidenteditrm']);
Route::post('/admin-incident-store', ['uses' => 'DashboardController@incidentformstore']);
Route::get('/admin-incident-edit/{id}', ['uses' => 'DashboardController@incidentedit']);
Route::post('/admin-incident-editstore', ['uses'=>'DashboardController@incidenteditstore']);
Route::get('/admin-incident-gettable', ['uses' => 'DashboardController@incidentgettable']);
    });
 });
// //File Manager
 Route::group(['middleware' => 'auth'], function () {
     Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
//     // list all lfm routes here...
 });




// Route::get('/admin-reportform', ['uses' => 'Admin\DashboardController@reportform']);
// Route::get('/admin-dashboard', ['uses' => 'Admin\DashboardController@dashboard']);
// Route::get('/admin-myhealth', ['uses' => 'Admin\DashboardController@myhealth']);
// Route::get('/admin-incident', ['uses' => 'Admin\DashboardController@incident']);
// Route::post('/admin-incident-store', ['uses' => 'Admin\DashboardController@incidentformstore']);
// Route::get('/admin-incident-edit/{id}', ['uses' => 'Admin\DashboardController@incidentedit']);
//  Route::post('/admin-incident-editstore', ['uses' => 'Admin\DashboardController@incidenteditstore']);
// Route::get('/admin-incident-gettable', ['uses' => 'Admin\DashboardController@incidentgettable']);
//auth//

Route::get('/login', ['uses' => 'Auth\LoginController@index']);
Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);

Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
Route::get('/forgotpass', ['uses' => 'Auth\LoginController@forgotPassword']);

Route::post('/forgot', ['uses' => 'Auth\LoginController@forget']);
Route::get('/reset', ['uses' => 'Auth\LoginController@reset']);



//     Route::auth();

//    Route::get('/login', ['uses' => 'Auth\LoginController@index']);

// Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);
// Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
//     // Moving here will ensure that sessions, csrf, etc. is included in all these routes
// Route::middleware(['auth'])->group(function () {    
//     Route::get('/admin-dashboard', ['uses' => 'Admin\DashboardController@dashboard']);    
// });
   

