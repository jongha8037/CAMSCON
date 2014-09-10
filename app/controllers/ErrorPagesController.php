<?php

class ErrorPagesController extends BaseController {

	public function notAuthorized() {
		return View::make('error-pages.not-authorized', ViewData::get());
	}

	public function loginRequired() {
		return View::make('error-pages.login-required', ViewData::get());
	}

	public function notFound() {
		return View::make('error-pages.not-found', ViewData::get());
	}

}
