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

Route::get('/', array('uses'=>"StyleIconController@getListAll"));

/*Front-end Icon Routes*/
Route::get('{slug}/{ordering?}',
	array('uses'=>"StyleIconController@getListAll")
)->where(array('slug'=>'all|campus|street|brand|fashion-week|festival|club|men|ladies', 'ordering'=>'new|hot'));

Route::get('campus/{slug}/{ordering?}', function() {
	dd('Campus list!');
})->where('ordering', 'new|hot');

Route::get('campus/{slug}/{id}', function() {
	dd('Campus single!');
})->where('id', '[0-9]+');

/*Front-end Auth Routes*/
Route::post('auth/user/login/email', array('before'=>'csrf', 'uses'=>'UserController@loginWithEmail'));
Route::post('auth/user/login/fb', array('before'=>'csrf', 'uses'=>'UserController@loginWithFB'));
Route::get('user/signup', array('uses'=>'UserController@showSignup'));
Route::post('user/signup', array('before'=>'csrf', 'uses'=>'UserController@signupUser'));
Route::get('auth/user/reset-password/{token}', array('uses'=>'RemindersController@getReset'));
Route::post('auth/user/reset-password', array('before'=>'csrf', 'uses'=>'RemindersController@postReset'));
Route::get('auth/user/logout', array('uses'=>'UserController@logoutUser'));
Route::get('user/userbox', array('uses'=>'UserController@userBoxTemplate'));

/*Style icon editor routes*/
Route::get('post/style-icon/{id?}', array('before'=>'auth.active_photographers', 'uses'=>'StyleIconController@showEditor'))->where('id','[0-9]+');
Route::post('post/style-icon/upload/primary', array('auth.active_photographers', 'uses'=>'StyleIconController@uploadPrimary'));
Route::post('post/style-icon/upload/attachment', array('auth.active_photographers', 'uses'=>'StyleIconController@uploadAttachment'));


/*Admin Routes*/
Route::get('admin', function() {return Redirect::to('admin/dashboard');});
Route::group(array('prefix' => 'admin', 'before'=>'auth.admin'), function() {

	Route::get('dashboard', array('uses'=>'AdminController@showDashboard'));

	/*Admin Brands*/
	Route::get('brands', array('uses'=>'BrandsController@showDashboard'));
	Route::get('brands/edit/{brand_id}', array('uses'=>'BrandsController@showEditor'));
	Route::post('brands/save', array('uses'=>'BrandsController@saveBrand'));
	Route::post('brands/delete', array('uses'=>'BrandsController@deleteBrand'));

	/*Admin Categories*/
	Route::get('categories', array('uses'=>'CategoriesController@showDashboard'));
	Route::get('categories/edit/{category_id}', array('uses'=>'CategoriesController@showEditor'));
	Route::post('categories/save', array('uses'=>'CategoriesController@saveCategory'));
	Route::post('categories/change-parent', array('uses'=>'CategoriesController@changeParent'));
	Route::post('categories/delete', array('uses'=>'CategoriesController@deleteCategory'));

	/*Admin User Groups*/
	Route::get('user-groups/{queryType?}/{field?}', array('uses'=>'GroupsController@showUsers'));
	Route::post('user-groups/delete-checked', array('filter'=>'csrf', 'uses'=>'GroupsController@deleteUsers'));
	Route::post('user-groups/copy-checked', array('filter'=>'csrf', 'uses'=>'GroupsController@copyUsers'));
	Route::post('user-groups/move-checked', array('filter'=>'csrf', 'uses'=>'GroupsController@moveUsers'));

});

/*Admin User Routes*/
Route::get('auth/admin/login', array('before'=>'login-wall','uses'=>'AdminController@showLogin'));
Route::post('auth/admin/login/fb', array('before'=>'csrf','uses'=>'AdminController@loginWithFB'));
Route::post('auth/admin/login/email', array('before'=>'csrf','uses'=>'AdminController@loginWithEmail'));
Route::get('auth/admin/send-reset', array('uses'=>'RemindersController@getAdminRemind'));
Route::post('auth/admin/send-reset', array('uses'=>'RemindersController@postRemind'));
Route::get('auth/admin/logout', array('uses'=>'AdminController@logoutUser'));


/*Error Routes*/
Route::group(array('prefix' => 'error'), function() {

	Route::get('not-authorized', array('uses'=>'ErrorPagesController@notAuthorized'));
	Route::get('login-required', array('uses'=>'ErrorPagesController@loginRequired'));
	Route::get('not-found', array('uses'=>'ErrorPagesController@notFound'));

});


/*Mockup Routes*/
Route::get('mockup/main', function() {

	$photos=array(
		'mockup-assets/sample-content/1.jpg',
		'mockup-assets/sample-content/2.jpg',
		'mockup-assets/sample-content/3.jpg',
		'mockup-assets/sample-content/4.jpg',
		'mockup-assets/sample-content/5.jpg',
		'mockup-assets/sample-content/6.jpg',
		'mockup-assets/sample-content/7.jpg',
		'mockup-assets/sample-content/8.jpg',
		'mockup-assets/sample-content/9.jpg'
	);

	$icons=array();

	foreach($photos as $photo) {
		$icon=new stdClass();
		$icon->photo=asset($photo);
		$icon->name='이해인';
		$icon->meta='한국외국어대학교';
		$icon->author=new stdClass();
		$icon->author->photo=asset('mockup-assets/sample-content/author.jpg');
		$icon->author->name='캠스콘';
		$icons[]=$icon;
	}

	return View::make('mockup.main', array('icons'=>$icons));
});

Route::get('mockup/detail', function() {
	return View::make('mockup.detail');
});


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

Route::get('test/tracker', function() {
	dd(Tracker::get());
});

Route::get('test/fbuser', array('uses'=>'UserController@fbTest'));

Route::get('logout', function() {
	Auth::logout();
});
