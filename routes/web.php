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


//Admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['namespace' => 'Admin','middleware' => 'auth'], function(){

        Route::get('/admin-dashboard', ['uses' => 'DashboardController@adminDashboard']);


        //CMS
        Route::get('/cms-add', ['uses' => 'CmsController@cmsAdd']);
        Route::post('/cms-add-store', ['uses' => 'CmsController@cmsAddStore']);
        Route::get('/cms-list', ['uses' => 'CmsController@cmsList']);
        Route::get('/cms-get-table', ['uses' => 'CmsController@getTableCms']);
        Route::get('/cms-edit/{id}', ['uses' => 'CmsController@cmsEdit']);
        Route::post('/cms-edit-store', ['uses' => 'CmsController@cmsEditStore']);
        Route::get('/cms-delete/{id}', ['uses' => 'CmsController@cmsDelete']);

        //homemainslider

        Route::get('/main-slider-add', ['uses' => 'HomeMainSliderController@mainSliderAdd']);
        Route::post('/main-slider-add-save', ['uses' => 'HomeMainSliderController@mainSliderAddSave']);
        Route::get('/main-slider-list', ['uses' => 'HomeMainSliderController@mainSliderList']);
        Route::get('/main-slider-get-table', ['uses' => 'HomeMainSliderController@getTableMainSlider']);
        Route::get('/main-slider-edit/{id}', ['uses' => 'HomeMainSliderController@mainSliderEdit']);
        Route::post('/main-slider-edit-store', ['uses' => 'HomeMainSliderController@mainSliderEditStore']);
        Route::get('/main-slider-delete/{id}', ['uses' => 'HomeMainSliderController@mainSliderDelete']);






        Route::post('/ckeditor-upload', ['uses' => 'CkeditorUploadController@upload']);

        //homeslider
        Route::get('/home-slider-add', ['uses' => 'HomeSliderController@sliderAdd']);
        Route::post('/home-slider-add-save', ['uses' => 'HomeSliderController@sliderAddSave']);
        Route::get('/home-slider-list', ['uses' => 'HomeSliderController@sliderList']);
        Route::get('/home-slider-get-table', ['uses' => 'HomeSliderController@getTableSlider']);
        Route::get('/home-slider-edit/{id}', ['uses' => 'HomeSliderController@sliderEdit']);
        Route::post('/home-slider-edit-store', ['uses' => 'HomeSliderController@sliderEditStore']);
        Route::get('/home-slider-delete/{id}', ['uses' => 'HomeSliderController@sliderDelete']);


         //requestform(demo)
        Route::get('/request-form-add', ['uses' => 'RequestFormController@requestFormAdd']);



        //AboutSliderController
        Route::get('/slider-add', ['uses' => 'AboutSliderController@sliderAdd']);
        Route::post('/slider-add-save', ['uses' => 'AboutSliderController@sliderAddSave']);
        Route::get('/slider-list', ['uses' => 'AboutSliderController@sliderList']);
        Route::get('/slider-get-table', ['uses' => 'AboutSliderController@getTableSlider']);
        Route::get('/slider-delete/{id}', ['uses' => 'AboutSliderController@sliderDelete']);


        //Service
        Route::get('/service-add', ['uses' => 'ServiceController@serviceAdd']);
        Route::post('/service-add-save', ['uses' => 'ServiceController@serviceAddSave']);
        Route::get('/service-list', ['uses' => 'ServiceController@serviceList']);
        Route::get('/service-get-table', ['uses' => 'ServiceController@getTableService']);
        Route::get('/service-edit/{id}', ['uses' => 'ServiceController@serviceEdit']);
        Route::post('/service-edit-store', ['uses' => 'ServiceController@serviceEditStore']);
        Route::get('/service-delete/{id}', ['uses' => 'ServiceController@serviceDelete']);

        //settings
        Route::get('/settings', ['uses' => 'SettingsController@settingsEdit']);
        Route::post('/settings-save', [ 'uses' => 'SettingsController@settingsSave']);








    });
});
//File Manager
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});





//frontend//
Route::group(['namespace' => 'Frontend'], function(){

    Route::get('/', ['uses' => 'HomeController@index']);

    Route::get('services', ['uses' => 'HomeController@services']);

    Route::get('service-page/{seo}', ['uses' => 'HomeController@servicePage']);

    Route::get('about', ['uses' => 'HomeController@about']);

    Route::get('my-dashboard', ['uses' => 'HomeController@mydashboard']);

    Route::get('appointments', ['uses' => 'HomeController@appointments']);

    Route::get('my-payment-history', ['uses' => 'HomeController@mypaymenthistory']);

    Route::get('my-prescription', ['uses' => 'HomeController@myprescription']);

    Route::get('reschedule-appointments', ['uses' => 'HomeController@rescheduleappointments']);


    Route::get('visionmission', ['uses' => 'HomeController@visionmision']);

    Route::get('contact', ['uses' => 'HomeController@contact']);

    //requestform
    Route::post('/request-add', ['uses' => 'HomeController@requestFormAdd']);

    //bookingform
    Route::post('/booking-add', ['uses' => 'HomeController@bookingFormAdd']);

   //ask expert
    Route::post('/ask-add', ['uses' => 'HomeController@askAdd']);

   //contactform
    Route::post('/contact-add', ['uses' => 'HomeController@contactAdd']);

    //ask question
    Route::post('/askquetion-add', ['uses' => 'HomeController@askQuestionAdd']);

    //emailsubcribe
    Route::post('/emil-add', ['uses' => 'HomeController@emilAdd']);

    //edit patient profile
    Route::get('/edit-profile/{id}', ['uses' => 'PatientController@ProfileEdit']);
    Route::post('/edit-profile-save', [ 'uses' => 'PatientController@ProfileSave']);




});

//auth//
Route::get('/login', ['uses' => 'Auth\LoginController@index']);

Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);

Route::get('/registration', ['uses' => 'Auth\LoginController@registration']);


Route::get('/logout', [ 'uses' => 'Auth\LoginController@logout']);
