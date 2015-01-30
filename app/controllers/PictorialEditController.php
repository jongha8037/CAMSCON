<?php
class PictorialEditController extends BaseController {

	public function showList() {
		$pictorials=SimplePictorial::with('attachments')->orderBy('id', 'DESC')->paginate(20);
		ViewData::add('pictorials', $pictorials);

		return View::make('admin.editorials.pictorials.list', ViewData::get());
	}//showList()

	public function showEditor($pictorial_id=null) {
		if($pictorial_id) {
			$pictorial=SimplePictorial::with('attachments')->find($pictorial_id);

			if(!$pictorial) {
				//Abort 404
				App::abort(404);
			}
		} else {
			//Create new SimplePictorial and EditorialPost models
			$pictorial=new SimplePictorial;
			$pictorial->user_id=Auth::user()->id;
			$pictorial->title='임시글 ('.date('Y-m-d H:i:s').')';
			$pictorial->save();

			//Redirect
			return Redirect::to(action('PictorialEditController@showEditor', $pictorial->id));
		}

		ViewData::add('pictorial', $pictorial);

		return View::make('admin.editorials.pictorials.editor', ViewData::get());
	}//showEditor()

	public function saveEntry() {
		$input=Input::only('entry_id', 'entry_title', 'entry_excerpt', 'entry_content', 'entry_status');

		$validationRules=array(
			'entry_id'=>array('required', 'exists:simple_pictorials,id'), 
			'entry_title'=>array('required'), 
			'entry_status'=>array('required', 'in:published,draft'), 
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$pictorial=SimplePictorial::find($input['entry_id']);

			$pictorial->title=$input['entry_title'];
			$pictorial->excerpt=$input['entry_excerpt'];
			$pictorial->text=$input['entry_content'];
			$pictorial->status=$input['entry_status'];

			$pictorial->save();

			return Redirect::to(action('PictorialEditController@showList'))->with('proc_success', 'saved');
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//saveEntry()

	public function deleteEntry() {
		$input=Input::only('entry_id');

		$validationRules=array(
			'entry_id'=>array('required', 'exists:simple_pictorials,id'), 
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$pictorial=SimplePictorial::find($input['entry_id']);

			DB::beginTransaction();
			try {
				$pictorial->attachments()->delete();
				$pictorial->delete();

				DB::commit();

				return Redirect::to(action('PictorialEditController@showList'))->with('proc_success', 'deleted');
			} catch(Exception $e) {//Log::info('transaction failed');
				DB::rollback();
				return Redirect::to(action('PictorialEditController@showList'))->with('proc_error', 'db_error');
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//deleteEntry()

	public function uploadAttachment() {
		$input=Input::only('entry_id');

		$validationRules=array(
			'entry_id'=>array('required', 'exists:simple_pictorials,id'), 
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$response=new stdClass;$response->type=null;$response->data=null;
			$pictorial=SimplePictorial::find($input['entry_id']);

			if(Input::hasFile('image')) {
				$img=new SimplePictorialAttachment;
				try {
					$img->setUploadedFile(Input::file('image'));
					$img->restrictWidth(800);

					if($pictorial->attachments()->save($img)) {
						//Attachment saved
						$response->type='success';
						$response->data='file_saved';
					} else {
						throw new Exception("Failed to save file.");
					}
				} catch(Exception $e) {Log::error($e);
					$response->type='error';
					$response->data='file_proc';
				}
			} else {
				$response->type='error';
				$response->data='no_file';
			}

			if($response->type==='error') {
				return Redirect::back()->with('proc_error', $response->data);
			} else {
				return Redirect::back()->with('proc_success', $response->data);
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//uploadAttachment()

	public function deleteAttachment() {
		//
	}//deleteAttachment()
	
}//PictorialEditController{}
?>