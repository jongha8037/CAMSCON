<?php
class UserFeedbackController extends BaseController {
	
	public function showForm() {
		return View::make('front.user-feedback.form', ViewData::get());
	}

	public function postFeedback() {
		$input=Input::only('feedback');

		$proc_result=null;
		if(!empty($input['feedback'])) {
			$model=new UserFeedback;
			$model->feedback=$input['feedback'];
			if(Auth::check()) {
				$model->user_id=Auth::user()->id;
			}

			if($model->save()) {
				$proc_result='success';
			} else {
				$proc_result='db_error';
			}
		} else {
			$proc_result='empty_input';
		}

		return Redirect::back()->with('proc_result', $proc_result);
	}

	public function showAdmin() {
		$entries=UserFeedback::orderBy('created_at', 'DESC')->paginate(5);
		ViewData::add('entries', $entries);
		return View::make('admin.user-feedback.list', ViewData::get());
	}

	public function deleteFeedback() {
		$input=Input::only('feedback_id');

		$validationRules=array(
			'feedback_id'=>array('required', 'exists:user_feedbacks,id')
		);

		$validator=Validator::make($input, $validationRules);

		$proc_result=null;
		if($validator->passes()) {
			if(UserFeedback::where('id', '=', $input['feedback_id'])->delete()) {
				$proc_result='success';
			} else {
				$proc_result='db_error';
			}
		} else {
			$proc_result='invalid_input';
		}

		return Redirect::back()->with('proc_result', $proc_result);
	}

}