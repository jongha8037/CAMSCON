<?php

class ErrorPagesController extends BaseController {

	public function notAuthorized() {
		return View::make('error-pages.not-authorized');
	}

	public function loginRequired() {
		return View::make('error-pages.login-required');
	}

}
