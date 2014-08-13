<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	return View::make('hello');
});

/*Front-end Routes*/
Route::get('auth/user/reset-password/{token}', array('uses'=>'RemindersController@getReset'));
Route::post('auth/user/reset-password', array('before'=>'csrf', 'uses'=>'RemindersController@postReset'));
Route::post('auth/user/login/email', array('before'=>'csrf', 'uses'=>'UserController@loginWithEmail'));
Route::post('auth/user/signup', array('before'=>'csrf', 'uses'=>'UserController@signupUser'));

/*Admin Routes*/
Route::when('admin/*', 'auth.admin');
Route::get('admin/dashboard', function() {dd('admin');});

/*Admin Brands*/
Route::get('admin/brands/dashboard', array('uses'=>'BrandsController@showDashboard'));
Route::get('admin/brands/edit/{brand_id}', array('uses'=>'BrandsController@showEditor'));
Route::post('admin/brands/save', array('uses'=>'BrandsController@saveBrand'));
Route::post('admin/brands/delete', array('uses'=>'BrandsController@deleteBrand'));

/*Admin Categories*/
Route::get('admin/categories/dashboard', array('uses'=>'CategoriesController@showDashboard'));
Route::get('admin/categories/edit/{category_id}', array('uses'=>'CategoriesController@showEditor'));
Route::post('admin/categories/save', array('uses'=>'CategoriesController@saveCategory'));
Route::post('admin/categories/change-parent', array('uses'=>'CategoriesController@changeParent'));
Route::post('admin/categories/delete', array('uses'=>'CategoriesController@deleteCategory'));

/*Admin User Groups*/
Route::get('admin/user-groups', array('uses'=>'GroupsController@showEditor'));

/*Admin User Routes*/
Route::get('auth/admin/login', array('before'=>'userdata','uses'=>'AdminController@showLogin'));
Route::post('auth/admin/login/fb', array('before'=>'csrf','uses'=>'AdminController@loginWithFB'));
Route::post('auth/admin/login/email', array('before'=>'csrf','uses'=>'AdminController@loginWithEmail'));
Route::get('auth/admin/send-reset', array('uses'=>'RemindersController@getAdminRemind'));
Route::post('auth/admin/send-reset', array('uses'=>'RemindersController@postRemind'));

/*Dev Routes*/

Route::get('/main', function()
{
	return View::make('front.main');
});

Route::get('admin/style-icon/editor', function()
{
	return View::make('admin.style-icon.editor');
});

Route::get('/pintest', function()
{
	return View::make('tests.pin');
});

Route::get('/jsontest', function() {
	$response=new stdClass();
	$response->result="success";
	$response->message="processed";
	return Response::json($response);
});

Route::get('/inputtest', function() {echo('start');
	$input=Input::only('first_input','second_input');
	if(Input::has('first_input')) {
		echo('has first input');
	}
	if(isset($input['first_input'])) {
		echo('first_input isset');
	}
	if(empty($input['first_input'])) {
		echo('empty');
	}
});

Route::get('/fb', function() {
	return View::make('fblogin');
});

Route::get('master-layout-test', function() {
	return View::make('tests.master-layout-test');
});

Route::get('test/login-modal', array('before'=>'userdata', function() {
	return View::make('tests.login-modal-test');
}));