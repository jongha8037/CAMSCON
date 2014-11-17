<?php
class CommentController extends BaseController {
	
	private $allowedTargets=array(
		'StreetSnap'=>'street_snaps',
		'UserComment'=>'user_comments'
	);

	public function saveComment() {
		$response=new stdClass;
		$response->type=null;
		$response->msg=null;
		$response->comments=null;

		$input=Input::only('target_type', 'target_id', 'content', 'self_id', 'parent_id');

		$targets=$this->allowedTargets;

		//Validate target_type first
		if(array_key_exists($input['target_type'], $targets)) {
			//Validation rules
			$rules=array(
				'target_id'=>array('required', sprintf('exists:%s,id', $targets[$input['target_type']]) ),
				'content'=>'required',
				'self_id'=>array('sometimes', 'exists:user_comments,id,user_id,'.Auth::user()->id),
				'parent_id'=>array('sometimes', 'exists:user_comments,id,deleted_at,NULL')
			);

			$validator=Validator::make($input, $rules);

			if($validator->passes()) {
				//Conditionally create or query UserComment
				if($input['self_id']) {
					$comment=UserComment::find($input['self_id']);
				} else {
					$comment=new UserComment;

					//Set user
					$comment->user_id=Auth::user()->id;

					//Set target
					$comment->target_type=$input['target_type'];
					$comment->target_id=$input['target_id'];

					//Conditionally set parent
					if($input['parent_id']) {
						$comment->parent_id=$input['parent_id'];
					} else {
						$comment->parent_id=0;
					}
				}

				//Set content
				$comment->comment=$this->filterComment($input['content']);

				//Save model
				if($comment->save()) {
					$response->type='success';
				} else {
					//DB error
					$response->type='error';
					$response->msg=trans('comment_messages.db_error');
				}

				//Get comments for response
				$response->comments=$this->fetchComments($input['target_type'], $input['target_id']);
			} else {
				//Validation failure
				$response->type='error';

				$messages=$validator->messages();
				if($messages->has('target_id')) {
					$response->msg=trans('comment_messages.invalid_input');
				} elseif($messages->has('content')) {
					$response->msg=trans('comment_messages.empty_content');
				} elseif($messages->has('self_id')) {
					$response->msg=trans('comment_messages.invalid_self_id');
				} elseif($messages->has('parent_id')) {
					$response->msg=trans('comment_messages.invalid_parent_id');
				} else {
					$response->msg=trans('comment_messages.unknown');
				}
			}
		} else {//target_type is invalid
			$response->type='error';
			$response->msg=trans('comment_messages.invalid_input');
		}

		return Response::json($response);
	}//saveComment()

	public function deleteComment() {
		$response=new stdClass;
		$response->type=null;
		$response->msg=null;
		$response->comments=null;

		$input=Input::only('target_type', 'target_id', 'self_id');

		//Validation rules
		$rules=array(
			'self_id'=>array('required', 'exists:user_comments,id,user_id,'.Auth::user()->id)
		);

		$validator=Validator::make($input, $rules);
		
		if($validator->passes()) {
			$comment=UserComment::find($input['self_id']);
			$target_type=$comment->target_type;
			$target_id=$comment->target_id;

			//Save model
			if($comment->delete()) {
				$response->type='success';
			} else {
				//DB error
				$response->type='error';
				$response->msg=trans('comment_messages.db_error');
			}

			//Get comments for response
			$response->comments=$this->fetchComments($target_type, $target_id);
		} else {
			//Invalid request
			$response->type='error';
			$response->msg=trans('comment_messages.invalid_input');
		}

		return Response::json($response);
	}//deleteComment()

	public function getComments() {
		$response=new stdClass;
		$response->type=null;
		$response->msg=null;
		$response->comments=null;

		$input=Input::only('target_type', 'target_id');

		$targets=$this->allowedTargets;

		//Validate target_type first
		if(array_key_exists($input['target_type'], $targets)) {
			$target=$input['target_type']::find($input['target_id']);

			if($target) {
				$response->type='success';
				$response->comments=$this->fetchComments($input['target_type'], $input['target_id']);
			} else {
				$response->type='error';
				$response->msg=trans('comment_messages.invalid_target');
			}
		} else {
			$response->type='error';
			$response->msg=trans('comment_messages.invalid_input');
		}

		return Response::json($response);
	}//getComments()

	private function fetchComments($target_type, $target_id) {
		//!Arguments MUST be validated prior to calling this method
		$target=$target_type::find($target_id);
		$comments=$target->comments()->with('user', 'user.profileImage', 'children', 'children.user', 'children.user.profileImage')->get();

		return $comments;
	}//fetchComments()

	private function filterComment($raw) {
		//This method filters raw input from a contenteditable div

		//Split raw input with delimiter <br>
		$split=explode('<br>', $raw);

		//Strip tags
		$procArray=array();
		foreach($split as $line) {
			$procArray[]=htmlentities($line, ENT_HTML5, 'UTF-8', false);
		}

		//Build clean string
		$clean=implode('<br>', $procArray);

		return $clean;
	}//filterComment()

}