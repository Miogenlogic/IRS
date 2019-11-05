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

//bookingform
Route::post('/booking-add', ['uses' => 'frontend\HomeController@bookingFormAdd']);
Route::post('/booking-otp', ['uses' => 'frontend\HomeController@bookingFormOtp']);


Route::post('/service-associated-doctors', ['uses' => 'frontend\HomeController@serviceAssociatedDoctors']);
Route::post('/service-type', ['uses' => 'frontend\HomeController@typeService']);


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



        //CmsMain Home Page
        Route::get('/cms-home-edit/{id}', ['uses' => 'CmsPageController@cmsHomeEdit']);
        Route::post('/cms-home-edit-store', ['uses' => 'CmsPageController@cmsHomeEditStore']);
        Route::get('/cms-home-list', ['uses' => 'CmsPageController@cmsHomeList']);
        Route::get('/cms-home-get-table', ['uses' => 'CmsPageController@getTableCmsHome']);

        //CmsMain About Page
        Route::get('/cms-about-edit/{id}', ['uses' => 'CmsPageController@cmsAboutEdit']);
        Route::post('/cms-about-edit-store', ['uses' => 'CmsPageController@cmsAboutEditStore']);
        Route::get('/cms-about-list', ['uses' => 'CmsPageController@cmsAboutList']);
        Route::get('/cms-about-get-table', ['uses' => 'CmsPageController@getTableCmsAbout']);

        //Cms visionmission
        Route::get('/cms-vision-edit/{id}', ['uses' => 'CmsPageController@cmsVisionEdit']);
        Route::post('/cms-vision-edit-store', ['uses' => 'CmsPageController@cmsVisionEditStore']);
        Route::get('/cms-vision-list', ['uses' => 'CmsPageController@cmsVisionList']);
        Route::get('/cms-vision-get-table', ['uses' => 'CmsPageController@getTableCmsVision']);


        //Cms contact
        Route::get('/cms-contact-edit/{id}', ['uses' => 'CmsPageController@cmsContactEdit']);
        Route::post('/cms-contact-edit-store', ['uses' => 'CmsPageController@cmsContactEditStore']);
        Route::get('/cms-contact-list', ['uses' => 'CmsPageController@cmsContactList']);
        Route::get('/cms-contact-get-table', ['uses' => 'CmsPageController@getTableCmsContact']);

        //service
        Route::get('/cms-service-edit/{id}', ['uses' => 'CmsPageController@servicetEdit']);
        Route::post('/cms-service-edit-store', ['uses' => 'CmsPageController@serviceEditStore']);
        Route::get('/cms-service-list', ['uses' => 'CmsPageController@serviceList']);
        Route::get('cms-service-get-table', ['uses' => 'CmsPageController@getTableService']);

        //service page
        Route::get('/cms-service-page-edit/{id}', ['uses' => 'CmsPageController@servicetPageEdit']);
        Route::post('/cms-service-page-edit-store', ['uses' => 'CmsPageController@servicePageEditStore']);
        Route::get('/cms-service-page-list', ['uses' => 'CmsPageController@servicePageList']);
        Route::get('cms-service-page-get-table', ['uses' => 'CmsPageController@getTableServicePage']);




       /* Route::get('/cms-main-add', ['uses' => 'CmsMainController@cmsMainAdd']);
        Route::post('/cms-main-add-store', ['uses' => 'CmsMainController@cmsMainAddStore']);
        Route::get('/cms-main-list', ['uses' => 'CmsMainController@cmsMainList']);
        Route::get('/cms-main-get-table', ['uses' => 'CmsMainController@getTableCmsMain']);
        Route::get('/cms-main-edit/{id}', ['uses' => 'CmsMainController@cmsMainEdit']);
        Route::post('/cms-main-edit-store', ['uses' => 'CmsMainController@cmsMainEditStore']);
        Route::get('/cms-main-delete/{id}', ['uses' => 'CmsMainController@cmsMainDelete']);

        //CmsPage
        Route::get('/cms-page-add/{id}', ['uses' => 'CmsPageController@cmsPageAdd']);
        Route::post('/cms-page-add-store', ['uses' => 'CmsPageController@cmsPageAddStore']);
        Route::get('/cms-page-list/{id}', ['uses' => 'CmsPageController@cmsPageList']);
        Route::get('/cms-page-get-table', ['uses' => 'CmsPageController@getTableCmsPage']);
        Route::get('/cms-page-edit/{id}', ['uses' => 'CmsPageController@cmsPageEdit']);
        Route::post('/cms-page-edit-store', ['uses' => 'CmsPageController@cmsPageEditStore']);
        Route::get('/cms-page-delete/{id}', ['uses' => 'CmsPageController@cmsPageDelete']);*/



        //user
        Route::get('/user-add', ['uses' => 'UserController@userAdd']);
        Route::post('/user-add-store', ['uses' => 'UserController@userAddStore']);
        Route::get('/user-list', ['uses' => 'UserController@userList']);
        Route::get('/user-get-table', ['uses' => 'UserController@getTableUser']);

        Route::get('/user-edit/{id}', ['uses' => 'UserController@userEdit']);
        Route::post('/user-edit-store', ['uses' => 'UserController@userEditStore']);

       //service modal
        Route::get('/service-modal-add', ['uses' => 'ServiceController@serviceModalAdd']);
        Route::post('/service-modal-add-store', ['uses' => 'ServiceController@serviceModalAddStore']);
        Route::get('/service-modal-list', ['uses' => 'ServiceController@serviceModalList']);
        Route::get('/service-modal-get-table', ['uses' => 'ServiceController@getTableServiceModal']);

        Route::get('/service-modal-edit/{id}', ['uses' => 'ServiceController@serviceModalEdit']);
        Route::post('/service-modal-edit-store', ['uses' => 'ServiceController@serviceModalEditStore']);
        Route::get('/service-modal-delete/{id}', ['uses' => 'ServiceController@serviceModalDelete']);



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
        //Route::get('/request-form-add', ['uses' => 'RequestFormController@requestFormAdd']);



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

     //inquery
        Route::get('/inquiry-list', ['uses' => 'InquiryController@inquiryList']);
        Route::get('/inquiry-get-table', ['uses' => 'InquiryController@getTableInquiry']);


        //Reply Inquiry
        Route::get('/reply-inquiry/{id}', ['uses' => 'InquiryController@replyInquiry']);
       // Route::get('/reply-inquiry-send', ['uses' => 'InquiryController@getTableReplyInquiry']);

        Route::post('/confirm-emil', ['uses' => 'InquiryController@emilConfirm']);

     //reply Questions
        Route::get('/question-list', ['uses' => 'InquiryController@questionList']);
        Route::get('/question-get-table', ['uses' => 'InquiryController@getTableQuestion']);
        Route::get('/reply-question/{id}', ['uses' => 'InquiryController@replyQuestion']);
        Route::post('/question-emil-send', ['uses' => 'InquiryController@emilQuestion']);

        //reply Contact
        Route::get('/contact-list', ['uses' => 'InquiryController@contactList']);
        Route::get('/contact-get-table', ['uses' => 'InquiryController@getTableContact']);
        Route::get('/reply-contact/{id}', ['uses' => 'InquiryController@replyContact']);
        Route::post('/contact-emil-send', ['uses' => 'InquiryController@emilContact']);


        //dashboard
        Route::get('/booking-list', ['uses' => 'InquiryController@bookingList']);
        Route::get('/booking-get-table', ['uses' => 'InquiryController@getTableBooking']);

        Route::post('/name-filter', ['uses' => 'InquiryController@nameFilter']);



    });
});
//File Manager
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});





//frontend//
Route::group(['namespace' => 'frontend'], function(){
    Route::group(['middleware' => 'auth'], function() {

        Route::get('my-dashboard', ['uses' => 'HomeController@mydashboard']);
        Route::get('appointments', ['uses' => 'HomeController@appointments']);
        Route::get('my-payment-history', ['uses' => 'HomeController@mypaymenthistory']);
        Route::get('my-prescription', ['uses' => 'HomeController@myprescription']);
        Route::get('reschedule-appointments', ['uses' => 'HomeController@rescheduleappointments']);


    });
    //AJAX
    Route::post('/state-by-country-id', ['uses' => 'AjaxController@stateByCountryId']);
    Route::post('/city-by-state-id', ['uses' => 'AjaxController@cityByStateId']);

    Route::get('/', ['uses' => 'HomeController@index']);

    Route::get('services', ['uses' => 'HomeController@services']);

    Route::get('service-page/{seo}', ['uses' => 'HomeController@servicePage']);

    Route::get('about', ['uses' => 'HomeController@about']);



    Route::get('visionmission', ['uses' => 'HomeController@visionmision']);

    Route::get('contact', ['uses' => 'HomeController@contact']);

    //requestform
    Route::post('/request-add', ['uses' => 'HomeController@requestFormAdd']);



   //ask expert
    Route::post('/ask-add', ['uses' => 'HomeController@askAdd']);

   //contactform
    Route::post('/contact-add', ['uses' => 'HomeController@contactAdd']);

    //ask question
    Route::post('/askquetion-add', ['uses' => 'HomeController@askQuestionAdd']);

    //emailsubcribe
    Route::post('/emil-add', ['uses' => 'HomeController@emilAdd']);

    //edit patient profile
    Route::get('/edit-profile', ['uses' => 'PatientController@ProfileEdit']);
    Route::post('/edit-profile-save', [ 'uses' => 'PatientController@ProfileSave']);

    Route::get('/appointment-list', ['uses' => 'PatientController@appointmentList']);

    Route::get('/appointment-get-table', ['uses' => 'PatientController@getTableAppointment']);



});

//auth//
Route::get('/login', ['uses' => 'Auth\LoginController@index']);

Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);

Route::get('/registration', ['uses' => 'Auth\LoginController@registration']);

Route::post('/register-save', [ 'uses' => 'Auth\LoginController@registerStore']);

//mail for otp
Route::post('/otp-mail', [ 'uses' => 'Auth\LoginController@otpMail']);

Route::get('/registration-validation/{str}', ['uses' => 'Auth\LoginController@registrationValidation']);

Route::post('/registration-validation-check', ['uses' => 'Auth\LoginController@registrationValidationCheck']);

Route::get('/activation/', ['uses' => 'Auth\LoginController@activation']);

Route::get('/forgot-password/', ['uses' => 'Auth\LoginController@forgotPassword']);

Route::post('/reset-mail', [ 'uses' => 'Auth\LoginController@resetMail']);

Route::get('/reset/', ['uses' => 'Auth\LoginController@reset']);

Route::get('/logout', [ 'uses' => 'Auth\LoginController@logout']);


