<?php

class InspirerRegisterController extends BaseController {

	public function showRegister() {
		return View::make('front.inspirer-register.register', ViewData::get());
	}//showRegister()

	public function postRegister() {
		Input::flash();
		$input=Input::only('name', 'nickname', 'mobile', 'email', 'website', 'blog', 'facebook', 'instagram', 'camscon');

		$validationRules=array(
			'name'=>'required',
			'nickname'=>'required',
			'mobile'=>'required',
			'email'=>'required|email',
			'website'=>'sometimes|url',
			'blog'=>'sometimes|url',
			'facebook'=>'sometimes|url',
		);/*Note: Maybe it would be a good idea to validate the camscon field*/

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			//
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//postRegister()

}