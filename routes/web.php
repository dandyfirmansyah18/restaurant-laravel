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

Route::middleware(['log'])->group(function(){

	// Route::get('/', 'HomeController@index');
	Route::get('/', ['as'=>'login', 'uses'=>'Auth\LoginController@login']);
	Route::get('news/{type}/{id?}', 'HomeController@news');
	Route::get('kpmfront/{type}/{id?}', 'HomeController@kpmfront');
	Route::get('regulation/{type}', 'HomeController@regulation');

	Route::get('companyprofile', 'HomeController@company_profile');
	Route::get('contactus', 'HomeController@contactus');
	Route::post('contactus/sendmessage', 'HomeController@sendmessage');
	Route::get('client', 'HomeController@client');

	Route::get('login', ['as'=>'login', 'uses'=>'Auth\LoginController@login']);
	Route::post('postlogin', 'Auth\LoginController@postLogin');
	Route::post('forgotpassword', 'Auth\LoginController@forgotpassword');
	Route::get('resetpassword', 'Auth\LoginController@resetpassword');

	Route::get('searching/{keyword?}', 'HomeController@search');
	Route::get('drawchart/stocksummary', 'HomeController@drawchart');

	Route::get('showSlider', 'HomeController@showSlider');

	Route::get('management-stocksum/export/{type?}/{emiten?}/{periode?}/{filename?}', 'StocksumController@export');	
	Route::post('management-stocksum/saveChart', 'StocksumController@saveChart');

	Route::get('preview/{tipe}/{id}', 'CaController@preview');

	Route::middleware(['auth'])->group(function(){

		Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'DashboardController@index']);
		Route::post('dashboard', 'DashboardController@view_dashboard');
		Route::get('dashboard/list/{type}/{limit?}', 'DashboardController@listdata');
		Route::post('dashboard/detail/{type}', 'DashboardController@detail');

		Route::middleware(['adminsalesrole'])->group(function(){
			
			
			// company profile
			Route::post('management-comprof/save', 'ComprofController@save');
			Route::post('management-comprof/view', 'ComprofController@view');
						
			// report
			Route::post('management-report/save', 'ReportController@save');
			Route::get('management-report/view', 'ReportController@view');
			Route::get('management-report/delete', 'ReportController@delete');
			
			// management user
			Route::post('management-user/list/{type}', 'ManagementUserController@userlist');
			Route::get('management-user/list/{type}/{id?}', 'ManagementUserController@userlist');
			Route::get('management-user/view', 'ManagementUserController@view');
			Route::get('management-user/viewusercashier', 'ManagementUserController@viewusercashier');
			Route::get('management-user/delete', 'ManagementUserController@delete');
			Route::get('management-user/deletecashier', 'ManagementUserController@delete_cashier_profile');
			Route::get('management-user/activate', 'ManagementUserController@activate');
			
			// contact us
			Route::post('management-contactus/list', 'ContactUsController@contactuslist');
			Route::get('management-contactus/data', 'ContactUsController@contactusdata');
			Route::post('management-contactus/save', 'ContactUsController@save');
			Route::get('management-contactus/view', 'ContactUsController@view');
			Route::get('management-contactus/reply', 'ContactUsController@reply');
			
			// dashboard chart
			Route::get('dashboard-chart/{type}', 'DashboardController@chart');

			// master
			Route::post('management-master/list/{type?}', 'MasterController@masterlist');
			Route::get('management-master/data/{type?}', 'MasterController@masterdata');
			Route::post('management-master/save/{type?}', 'MasterController@save');
			Route::get('management-master/view/{type?}', 'MasterController@view');
			Route::get('management-master/delete/{type?}', 'MasterController@delete');
			Route::get('management-master/activate/{type?}', 'MasterController@activate');
			Route::get('management-master/checksort/{id?}/{type?}', 'MasterController@checksort');

			Route::post('management-pos/view', 'POSController@index');
			Route::get('management-pos/getDetailTransaction', 'POSController@getDetailTransaction');
			Route::post('management-pos/updateamounttemp', 'POSController@updateamounttemp');
			Route::post('management-pos/addmenus', 'POSController@addmenus');
			Route::post('management-pos/deletedetailtemp', 'POSController@deletedetailtemp');
			Route::post('management-pos/save', 'POSController@save');
			Route::post('management-pos/list', 'POSController@list');
			Route::get('management-pos/datapos', 'POSController@datapos');
			Route::get('management-pos/DetailPOS', 'POSController@DetailPOS');
			

			Route::get('/pos_form_print/{id}','POSController@pos_form_print');
			
		});		

		// report
		Route::post('management-report/list/{periode?}', 'ReportController@reportlist');
		Route::get('management-report/data/{periode?}', 'ReportController@reportdata');
		Route::get('management-report/sendotp/{type?}', 'ReportController@sendotp');
		Route::post('management-report/sendcode', 'ReportController@sendcode');
		Route::get('downloadfile/{type}/{id}', 'ReportController@downloadfile');

		Route::post('uploadimage', 'NewsController@uploadimage');
		

		// management user
		Route::post('management-user/save', 'ManagementUserController@save');
		Route::post('management-user/emitenstaff/{type}', 'ManagementUserController@emitenstaff');
		Route::get('management-user/emitenstaff/{type}', 'ManagementUserController@emitenstaff');
		Route::post('management-user/changepassword', 'ManagementUserController@changepassword');
		Route::post('management-user/password_file/{type}', 'ManagementUserController@password_file');

		Route::get('reference/address', 'ReferenceController@address');
		Route::get('reference/checkemailifexist', 'ReferenceController@checkemailifexist');
		Route::get('reference/checkNpwpifexist', 'ReferenceController@checkNpwpifexist');
		Route::get('reference/checkCashierCodeifexist', 'ReferenceController@checkCashierCodeifexist');		

		Route::post('profile', 'ManagementUserController@profile');
		Route::get('logout', 'Auth\LoginController@logout');

		Route::get('insertlog/{type}/{id}', 'ReferenceController@insertlog');

		// management-stocksummary
		Route::post('management-stocksum/list/{emiten?}/{periode?}', 'StocksumController@stocksumlist');
		Route::get('management-stocksum/data/{emiten?}/{periode?}', 'StocksumController@stocksumdata');
		Route::post('management-stocksum/save', 'StocksumController@save');		
		Route::get('management-stocksum/view', 'StocksumController@view');
		Route::get('management-stocksum/delete', 'StocksumController@delete');
		

	});
});