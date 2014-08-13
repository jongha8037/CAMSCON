<?php

class UserController extends BaseController {

	public function showSignupPage() {
		return View::make('front.user.signup-page');
	}//showSignupPage()

	public function signupUser() {
		//
	}//signupUser()

	public function showSignupModal() {}//showSignupModal()

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
			$user = User::whereHas('facebook_account', function($query) use($fbUserId) {
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

}
