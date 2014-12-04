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
			'camscon'=>'required'
		);/*Note: Maybe it would be a good idea to apply strict validation to the camscon field*/

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$form=new InspirerRegistrationForm;
			$form->name=$input['name'];
			$form->nickname=$input['nickname'];
			$form->mobile=$input['mobile'];
			$form->email=$input['email'];
			$form->website=$input['website'];
			$form->blog=$input['blog'];
			$form->facebook=$input['facebook'];
			$form->instagram=$input['instagram'];
			$form->camscon=$input['camscon_id'];

			if($form->save()) {
				return Redirect::back()->with('proc_result', 'success');
			} else {
				return Redirect::back()->with('proc_result', 'db_error');
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//postRegister()

}