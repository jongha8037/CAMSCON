<?php
class CommentController extends BaseController {
	
	public function saveComment() {
		$input=Input::only('target_type', 'target_id', 'content');
		return Response::json($input);
	}

	public function deleteComment() {
		//
	}

	private function filterComment() {
		//
	}

}