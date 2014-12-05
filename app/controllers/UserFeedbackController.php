<?php
class UserFeedbackController extends BaseController {
	
	public function showForm() {
		return View::make('front.user-feedback.form', ViewData::get());
	}

}