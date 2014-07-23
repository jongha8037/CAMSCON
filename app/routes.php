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

Route::get('/', function()
{
	return View::make('hello');
});


/*Admin Routes*/
Route::get('/admin/brands', function() {
	return View::make('admin.brands.dashboard');
});


/*Dev Routes*/

Route::get('/main', function()
{
	return View::make('front.main');
});

Route::get('/admin/style-icon/editor', function()
{
	return View::make('admin.style-icon.editor');
});

Route::get('/pintest', function()
{
	return View::make('tests.pin');
});