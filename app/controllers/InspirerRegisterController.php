<?php

class InspirerRegisterController extends BaseController {

	private $statuses=array('pending_approval', 'approved', 'declined');

	public function showRegister() {
		return View::make('front.inspirer-register.register', ViewData::get());
	}//showRegister()

	public function postRegister() {
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
			$form->camscon_id=$input['camscon'];

			if($form->save()) {
				return Redirect::back()->with('proc_result', 'success');
			} else {
				Input::flash();
				return Redirect::back()->with('proc_result', 'db_error');
			}
		} else {
			Input::flash();
			return Redirect::back()->withErrors($validator);
		}
	}//postRegister()

	public function showAdmin() {
		$input=Input::only('status');

		$status=null;
		if(in_array($input['status'], $this->statuses)) {
			$status=$input['status'];
		} else {
			$status='pending_approval';
		}
		ViewData::add('status', $status);

		$forms=InspirerRegistrationForm::where('status', '=', $status)->orderBy('created_at', 'DESC')->paginate(25);
		$forms->appends(array('status'=>$status));
		ViewData::add('forms', $forms);

		return View::make('admin.inspirer-register.list', ViewData::get());
	}//showAdmin()

	public function changeStatus($status) {
		$input=Input::only('checked');
		$raw=json_decode($input['checked']);
		
		$checked=$this->filterCheckedArray($raw);

		$currentStatus=null;
		if(in_array($status, $this->statuses)) {
			$currentStatus=$status;
		} else {
			$currentStatus='pending_approval';
		}

		$affectedRows=0;
		if(count($checked)>0) {
			$affectedRows=InspirerRegistrationForm::whereIn('id', $checked)->update(array('status'=>$currentStatus));
		}

		return Redirect::to(action('InspirerRegisterController@showAdmin', array('status'=>$currentStatus)))->with('affectedRows', $affectedRows);
	}//changeStatus()

	public function deleteForms() {
		$input=Input::only('checked');
		$raw=json_decode($input['checked']);
		
		$checked=$this->filterCheckedArray($raw);

		$affectedRows=0;
		if(count($checked)>0) {
			$affectedRows=InspirerRegistrationForm::whereIn('id', $checked)->delete();
		}

		$status=null;
		if(in_array($_GET['status'], $this->statuses)) {
			$status=$_GET['status'];
		} else {
			$status='pending_approval';
		}

		return Redirect::to(action('InspirerRegisterController@showAdmin', array('status'=>$status)))->with('affectedRows', $affectedRows);
	}//deleteForms()

	private function filterCheckedArray($rawArray) {
		$cleanArray=array();
		
		if(is_array($rawArray)) {
			foreach($rawArray as $rawId) {
				$cleanId=intval($rawId);
				if($cleanId>0 && !in_array($cleanId, $cleanArray)) {
					$cleanArray[]=$cleanId;
				}
			}
		}

		return $cleanArray;
	}//filterCheckedArray()

}