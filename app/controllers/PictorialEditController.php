<?php
class PictorialEditController extends BaseController {

	public function showList() {
		$pictorials=SimplePictorial::with('post', 'post.user')->orderBy('id', 'DESC')->paginate(20);
		ViewData::add('pictorials', $pictorials);

		return View::make('admin.editorials.pictorials.list', ViewData::get());
	}//showList()

	public function showEditor($pictorial_id=null) {
		if($pictorial_id) {
			$pictorial=SimplePictorial::with('post', 'post.thumbnail', 'attachments')->find($pictorial_id);

			if(!$pictorial) {
				//Abort 404
				App::abort(404);
			}
		} else {
			//Create new SimplePictorial and EditorialPost models
			$pictorial=new SimplePictorial;
			$post=new EditorialPost;
			$post->category_id=1;//Pictorial category
			$post->content_type='SimplePictorial';
			$post->user_id=Auth::user()->id;
			$post->title='임시글 ('.date('Y-m-d H:i:s').')';

			//Transaction
			DB::beginTransaction();
			try {
				$pictorial->save();
				$post->content_id=$pictorial->id;
				$post->save();

				DB::commit();
			} catch(Exception $e) {//Log::info('transaction failed');
				DB::rollback();
				//Redirect back with error
			}
		}

		ViewData::add('pictorial', $pictorial);

		return View::make('admin.editorials.pictorials.editor', ViewData::get());
	}//showEditor()
	
}//PictorialEditController{}
?>