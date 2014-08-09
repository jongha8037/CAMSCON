<?php

class UserController extends BaseController {

	public function showSignupPage() {
		return View::make('front.user.signup-page');
	}//showSignupPage()

	public function signupUser() {
		//
	}//signupUser()

	public function showSignupModal() {}//showSignupModal()

}
