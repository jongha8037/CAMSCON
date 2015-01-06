<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			Session::put('intended', Request::url());
			return Redirect::guest('auth/login-required');
		}
	}
});


Route::filter('auth.active_photographers', function() {
	if(Auth::check()) {
		//User is logged in check groups
		$groups=Auth::user()->groups;
		$authGroup=array(1,2,3,4,5,6);
		$auth=false;
		foreach($groups as $group) {
			if( in_array(intval($group->id), $authGroup) ) {
				$auth=true;
				break;
			}
		}

		if(!$auth) {
			if (Request::ajax()) {
				return Response::make('Unauthorized', 401);
			} else {
				return View::make('error-pages.not-authorized', ViewData::get());
			}
		}
	} else {
		//User is not logged in
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('error/login-required')->with('intended',Request::url());
		}
	}
});

Route::filter('auth.admin', function() {
	if(Auth::check()) {
		//User is logged in check groups
		$groups=Auth::user()->groups;
		$isAdmin=false;
		foreach($groups as $group) {
			if(intval($group->id)===5 || intval($group->id)===6) {
				$isAdmin=true;
				break;
			}
		}

		if(!$isAdmin) {
			App::abort(401);
		}
	} else {
		//User is not logged in
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('auth/admin/login')->with('intended',Request::url());
		}
	}
});

Route::filter('auth.superuser', function() {
	if(Auth::check()) {
		//User is logged in check groups
		$groups=Auth::user()->groups;
		$authGroup=array(6);
		$auth=false;
		foreach($groups as $group) {
			if( in_array(intval($group->id), $authGroup) ) {
				$auth=true;
				break;
			}
		}

		if(!$auth) {
			if (Request::ajax()) {
				return Response::make('Unauthorized', 401);
			} else {
				return View::make('error-pages.not-authorized', ViewData::get());
			}
		}
	} else {
		//User is not logged in
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('error/login-required')->with('intended',Request::url());
		}
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('tracker', function() {
	Tracker::addPageCount();
});

Route::filter('restricted-page', function() {
	Tracker::addRestrictedCount();
});

Route::filter('front', function() {
	$catNav=new stdClass();

	//Build Campus menu
	$catNav->campus=array();
	$campusMeta=CampusMeta::orderBy('name_ko', 'ASC')->remember(60)->get();
	foreach ($campusMeta as $meta) {
		$campus=new stdClass();
		$campus->id=$meta->id;
		$campus->name=$meta->name;
		$campus->slug=$meta->slug;
		$catNav->campus[]=$campus;
	}

	//Build Street menu
	$catNav->street=array();
	$streetMeta=StreetMeta::orderBy('name_ko', 'ASC')->remember(60)->get();
	foreach ($streetMeta as $meta) {
		$street=new stdClass();
		$street->id=$meta->id;
		$street->name=$meta->name;
		$street->slug=$meta->slug;
		$catNav->street[]=$street;
	}

	//Build Street menu
	$catNav->blog=array();
	$blogMeta=BlogMeta::orderBy('name', 'ASC')->remember(60)->get();
	foreach ($blogMeta as $meta) {
		$blog=new stdClass();
		$blog->id=$meta->id;
		$blog->name=$meta->name;
		$blog->slug=$meta->slug;
		$catNav->blog[]=$blog;
	}

	//Build Festival menu
	$catNav->festival=array();
	$festivalMeta=FestivalMeta::orderBy('name_ko', 'ASC')->remember(60)->get();
	foreach ($festivalMeta as $meta) {
		$festival=new stdClass();
		$festival->id=$meta->id;
		$festival->name=$meta->name;
		$festival->slug=$meta->slug;
		$catNav->festival[]=$festival;
	}

	//Build Club menu
	$catNav->club=array();
	$clubMeta=ClubMeta::orderBy('name_ko', 'ASC')->remember(60)->get();
	foreach ($clubMeta as $meta) {
		$club=new stdClass();
		$club->id=$meta->id;
		$club->name=$meta->name;
		$club->slug=$meta->slug;
		$catNav->club[]=$club;
	}

	//Build Club menu
	$catNav->fashionweek=array();
	$fashionweekMeta=FashionWeekMeta::orderBy('name_ko', 'ASC')->remember(60)->get();
	foreach ($fashionweekMeta as $meta) {
		$fashionweek=new stdClass();
		$fashionweek->id=$meta->id;
		$fashionweek->name=$meta->name;
		$fashionweek->slug=$meta->slug;
		$catNav->fashionweek[]=$fashionweek;
	}

	ViewData::add('CatNav', $catNav);
});