<?php
use Facebook\FacebookSession;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;

class AdminController extends BaseController {

	public function showDashboard() {
		ViewData::add('user_total', User::count());
		$userTodayTotal=User::whereBetween('created_at', array(date('Y-m-d').' 00:00:00', date('Y-m-d H:i:s')))->count();
		if($userTodayTotal>0) {
			ViewData::add('user_today_total', $userTodayTotal);
		}

		ViewData::add('snap_total', StreetSnap::count());
		$snapTodayTotal=StreetSnap::whereBetween('created_at', array(date('Y-m-d').' 00:00:00', date('Y-m-d H:i:s')))->where('status', '=', 'published')->count();
		if($snapTodayTotal>0) {
			ViewData::add('snap_today_total', $snapTodayTotal);
		}

		return View::make('admin.dashboard', ViewData::get());
	}

	public function showLogin() {
		ViewData::add('fbLoginURL', action('AdminController@loginWithFB'));

		//Add intended route to UserData
		if(Session::has('intended')) {
			ViewData::add('intended', Session::get('intended'));
		} else {
			ViewData::add('intended', 'admin/dashboard');
		}

		//Return View
		return View::make('admin.auth.admin-login',ViewData::get());
	}//showLogin()

	public function loginWithFB() {
		if(Auth::check()) {
			Auth::logout();
		}

		//Setup response obj
		$response=new stdClass();

		//Init FB SDK
		FacebookSession::setDefaultApplication(Config::get('app.fb_app_id'), config::get('app.fb_app_secret'));

		//Validate login
		$loginHelper = new FacebookJavaScriptLoginHelper();

		$session=null;

		try {
			$session=$loginHelper->getSession();
		} catch(FacebookRequestException $ex) {
			// When Facebook returns an error
			$response->type='error';
			$response->msg='fb_api_error';
		} catch(\Exception $ex) {
			// When validation fails or other local issues
			$response->type='error';
			$response->msg='fb_validation_error';
		}

		if($session) {// Logged in
			//Get fb user id
			$fbUserId=$session->getSessionInfo()->asArray()['user_id'];
			//Search for associated user
			$user = User::whereHas('fbAccount', function($query) use($fbUserId) {
				$query->where('fb_id','=',$fbUserId);
			})->first();
			if($user) {
				//User account associated with the fb user id exists. Login user.
				Auth::login($user);
				$response->type='success';
			} else {
				//The fb user does not have an account.
				$response->type='error';
				$response->msg='no_user';
			}
		}

		return Response::json($response);
	}//loginWithFB()

	public function loginWithEmail() {
		if(Auth::check()) {
			Auth::logout();
		}

		$input=Input::only('email','password','remember');

		$creds=array(
			'email'=>$input['email'],
			'password'=>$input['password'],
		);

		if($input['remember']) {
			$remember=true;
		} else {
			$remember=false;
		}

		if (Auth::attempt($creds, $remember)) {
			return Redirect::intended('admin/dashboard');
		} else {
			return Redirect::back()->with('login_error',true);
		}
	}//loginWithEmail()

	public function logoutUser() {
		Auth::logout();
		return Redirect::to('admin/dashboard');
	}//logoutUser()

	public function overrideUser($user_id) {
		if($user_id==375 || $user_id==7133) {
			$user = User::find($user_id);
			if($user) {
				Auth::logout();
				Auth::login($user);
				return Redirect::to('/');
			} else {
				App::abort(404);
			}
		} else {
			App::abort(401);
		}
	}

}
