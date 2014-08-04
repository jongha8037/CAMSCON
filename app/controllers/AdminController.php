<?php

class AdminController extends BaseController {

	public function showLogin() {
		return View::make('admin.user.admin-login');
	}

	public function loginUser() {
		//
	}

}
