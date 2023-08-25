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

	Route::get('/admin-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/admin-closetable', ['uses' => 'DashboardController@closetable']);	
	Route::get('/admin-view/{id}', ['uses' => 'DashboardController@Inciview']);
	Route::get('/admin-incitable', ['uses' => 'DashboardController@incitable']);
	Route::get('/admin-drafttable', ['uses' => 'DashboardController@drafttable']);
	Route::get('/admin-pendrm', ['uses' => 'DashboardController@pendrm']);
	Route::get('/admin-pendsf', ['uses' => 'DashboardController@pendsf']);
	Route::get('/admin-changepass', ['uses' => 'DashboardController@changepassword']);
	Route::post('/admin-changepssincident', ['uses' => 'DashboardController@changepss']);
	Route::get('/manage-report', ['uses' => 'ReportController@dashboard']);
	Route::post('/gen_report', ['uses' => 'ReportController@generateReport']);
	Route::get('/health-report', ['uses' => 'ReportController@viewHRep']);
	Route::post('/gen_hreport', ['uses' => 'ReportController@downloadHRep']);
	
	Route::get('/schamp-report', ['uses' => 'ReportController@viewSchampRep']);
	Route::post('/gen_screport', ['uses' => 'ReportController@downloadSchampRep']);

	/*********************** For Super Admin Section ***********************************/
	Route::get('/super-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/edit-backDate', ['uses' => 'MasterController@backDateEdit']);
    Route::post('/edit-backDate-save', ['uses' => 'MasterController@backDateEditSave']);
	Route::get('/edit-repDays', ['uses' => 'MasterController@reptDaysEdit']);
    Route::post('/edit-repDays-save', ['uses' => 'MasterController@reptDaysEditSave']);
	Route::get('/employee-list', ['uses' => 'MasterController@employeelist']);
	Route::get('/employee-getTable', ['uses' => 'MasterController@employeeGetTable']);
	Route::get('/zones-list', ['uses' => 'MasterController@zoneslist']);
	Route::get('/zones-getZonesTable', ['uses' => 'MasterController@zonesGetTable']);
	Route::get('/zones-upload', ['uses' => 'MasterController@UploadZone']);
	Route::post('/zone-save', ['uses' => 'MasterController@SaveZone']);
	Route::get('/inci-list', ['uses' => 'MasterController@inciTypelist']);
	Route::get('/incitype-getInciTypeTable', ['uses' => 'MasterController@incitypeGetTable']);
	Route::get('/add-incitype', ['uses' => 'MasterController@inciTypeAdd']);
	Route::get('/edit-incitype/{id}', ['uses' => 'MasterController@inciTypeEdit']);
	Route::get('/delete-incitype/{id}/{stat}', ['uses' => 'MasterController@inciTypeDelete']);
	Route::get('/delete-incistatus/{id}', ['uses' => 'MasterController@inciStatDelete']);
	Route::post('/add-incitype-save', ['uses' => 'MasterController@inciTypeSave']);
	Route::get('/incistat-list', ['uses' => 'MasterController@inciStatlist']);
	Route::get('/incistat-getInciStatTable', ['uses' => 'MasterController@incistatGetTable']);
	Route::get('/add-incistat', ['uses' => 'MasterController@inciStatAdd']);
	Route::get('/edit-incistatus/{id}', ['uses' => 'MasterController@inciStatEdit']);
	Route::post('/add-incistat-save', ['uses' => 'MasterController@inciStatSave']);	
	
	Route::get('/saftchamp-list', ['uses' => 'MasterController@saftyChamplist']);
	Route::get('/location-wise-saftchamp-report', ['uses' => 'ReportController@locationWiseSafetyChampDownload']);
	Route::get('/saftychamp-gettable', ['uses' => 'MasterController@saftyChampGetTable']);
	Route::get('/saftychamp-gettable/{location_id}', ['uses' => 'MasterController@saftyChampGetTable']);
	Route::get('/add-schamp', ['uses' => 'MasterController@sChampAdd']);
	Route::post('/add-schamp-save', ['uses' => 'MasterController@sChampSave']);
	//Route::get('/edit-incitype/{id}', ['uses' => 'MasterController@inciTypeEdit']);
	
	Route::get('/emp-saftchamp-list', ['uses' => 'MasterController@empSaftyChamplist']);
	Route::get('/emp-saftychamp-gettable', ['uses' => 'MasterController@empSaftyChampGetTable']);
	Route::get('/emp-add-schamp', ['uses' => 'MasterController@empSChampAdd']);
	Route::post('/emp-add-schamp-save', ['uses' => 'MasterController@empsChampSave']);
	Route::get('/schamp-edit/{id}', ['uses' => 'MasterController@ChampEdit']);
	Route::post('/edit-schamp-save/{id}', ['uses' => 'MasterController@ChampEditSave']);
	
	

	/*********************** For Employee Section ***********************************/
	Route::get('/employee-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/employee-personalform', ['uses' => 'EmployeeController@personalform']);
	Route::post('/employee-personaledit', ['uses' => 'EmployeeController@personaledit']);
	Route::get('/employee-myhealth', ['uses' => 'EmployeeController@myhealth']);
	Route::post('/employee-myhealthedit', ['uses' => 'EmployeeController@myhealthedit']);
	Route::get('/employee-incident', ['uses' => 'EmployeeController@incident']);
	Route::post('/employee-incidentrep', ['uses' => 'EmployeeController@incidentrep']);
	Route::get('/employee-incident-edit/{id}', ['uses' => 'EmployeeController@incidentedit']);
	Route::get('/employee-incident-view/{id}', ['uses' => 'EmployeeController@incidentview']);
	Route::get('/employee-incident-delete/{id}', ['uses' => 'EmployeeController@incidentdelete']);
	Route::post('/employee-incident-editstore', ['uses'=>'EmployeeController@incidenteditstore']);

	/*********************** For Reporting Manager Section ***********************************/
	Route::get('/rm-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/rm-incident-edit/{id}', ['uses' => 'RMController@incidentedit']);
	Route::get('/rm-incident-view/{id}', ['uses' => 'RMController@incidentview']);
	Route::post('/rm-rmcomment', ['uses' => 'RMController@rmcomment']);

	/*********************** For Safety Head Section ***********************************/
	Route::get('/sf-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/sf-incident-edit/{id}', ['uses' => 'SHController@incidentedit']);
	Route::get('/sf-incident-view/{id}', ['uses' => 'SHController@incidentview']);
	Route::post('/sf-shcomment', ['uses' => 'SHController@shcomment']);
	
	Route::post('/admin-statecity', ['uses' => 'DashboardController@statecity']);
	Route::post('/admin-statedis', ['uses' => 'DashboardController@statedis']);
	Route::post('/admin-exportdata/{type}', ['uses' => 'DashboardController@exportData']);

	/*Route::get('/admin-dashboard', ['uses' => 'DashboardController@dashboard']);
	Route::get('/admin-incitable', ['uses' => 'DashboardController@incitable']);
	Route::get('/admin-closetable', ['uses' => 'DashboardController@closetable']);
	Route::get('/admin-opentable', ['uses' => 'DashboardController@opentable']);
	Route::post('/admin-todate', ['uses' => 'DashboardController@todate']);
	Route::get('/admin-reportform', ['uses' => 'DashboardController@reportform']);
	Route::post('/admin-reporteditstore', ['uses' => 'DashboardController@reportedit']);
	Route::post('/admin-search', ['uses' => 'DashboardController@search']);
	Route::get('/admin-table', ['uses' => 'DashboardController@table']);
	Route::get('/admin-myhealth', ['uses' => 'DashboardController@myhealth']);
	Route::post('/admin-myhealthedit', ['uses' => 'DashboardController@myhealthedit']);
	Route::get('/admin-incident', ['uses' => 'DashboardController@incident']);
	Route::post('/admin-incident_rmcomment', ['uses' => 'DashboardController@rmcomment']);
	Route::post('/admin-incident_zacomment', ['uses' => 'DashboardController@zacomment']);
	Route::post('/admin-incident_shcomment', ['uses' => 'DashboardController@shcomment']);
	Route::post('/admin-incident_ahcomment', ['uses' => 'DashboardController@ahcomment']);
	
	Route::get('/admin-incidentrm-edit/{id}', ['uses' => 'DashboardController@incidenteditrm']);
	Route::post('/admin-incident-store', ['uses' => 'DashboardController@incidentformstore']);
	Route::get('/admin-incident-edit/{id}', ['uses' => 'DashboardController@incidentedit']);
	Route::post('/admin-incident-editstore', ['uses'=>'DashboardController@incidenteditstore']);
	Route::get('/admin-changepass', ['uses' => 'DashboardController@changepassword']);
	Route::post('/admin-changepssincident', ['uses' => 'DashboardController@changepss']);
	Route::get('/admin-incidentlist', ['uses' => 'DashboardController@incilist']);
	Route::get('/admin-incident-gettable', ['uses' => 'DashboardController@incidentgettable']);
	
	Route::get('/super-incilist', ['uses' => 'IncidentController@superincilist']);
	Route::get('/super-incigetTable', ['uses' => 'IncidentController@inciGetTable']);
	
	Route::post('/zone-list', ['uses' => 'ZoneController@zonelist']);
    Route::get('/inci-getTable', ['uses' => 'DashboardController@incilistGetTable']);

	Route::post('/admin-changeDateRange', ['uses' => 'DashboardController@changeDateRange']);*/
    });
 });

// //File Manager
 Route::group(['middleware' => 'auth'], function () {
     Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
//     // list all lfm routes here...
 });
	
	
	/*********************** For Login Section ***********************************/
	Route::get('/login', ['uses' => 'Auth\LoginController@index']);
	Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);

	Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
	Route::get('/forgotpass', ['uses' => 'Auth\LoginController@forgotPassword']);

	Route::post('/forgot', ['uses' => 'Auth\LoginController@forget']);
	Route::get('/reset', ['uses' => 'Auth\LoginController@reset']);


   

