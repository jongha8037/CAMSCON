<?php
class LikeController extends BaseController {
	
	private $targetTypes=array('StreetSnap');

	public function procLike() {
		$input=Input::only('target_type', 'target_id');
		$target=null;
		switch($input['target_type']) {
			case 'StreetSnap':
				$target=StreetSnap::with('liked')->find($input['target_id']);
				break;
		}

		$response=new stdClass();

		if($target) {
			$response->target_type=$input['target_type'];
			$response->target_id=$input['target_id'];
			if($target->liked->count()>0) {
				//Cancel like
				$target->liked->each(function($like) {
					$like->delete();
				});

				//Update cached_total_likes
				$target->cached_total_likes--;
				$target->save();

				$response->proc='canceled';
				$response->total=$target->cached_total_likes;
				return Response::json($response);
			} else {
				//Like
				$newLike=new UserLike;
				$newLike->user_id=Auth::user()->id;
				$target->likes()->save($newLike);

				//Update cached_total_likes
				$target->cached_total_likes++;
				$target->save();

				$response->proc='liked';
				$response->total=$target->cached_total_likes;
				return Response::json($response);
			}
		} else {
			$response->proc='error';
			return Response::json($response);
		}
	}//procLike()

	public function getCurrentUserSnapLikes() {
		//Only works for UserLike data associated with StreetSnap
		//This method will likely be deprecated when the universal getLikes() method becomes available

		//Setup response object
		$response=new stdClass();
		$response->type=null;$response->msg=null;$response->data=null;

		//Get input
		$input=Input::only('targets');
		$targets=$input['targets'];

		if(is_array($targets)) {//Validate input
			if(Auth::check()) {//Check user auth status
				//Build array of target_id's for querying
				$queryArray=array();
				foreach ($targets as $target) {
					$queryArray[]=intval($target);
				}

				//Query likes
				$userLikes=UserLike::where('target_type', '=', 'StreetSnap')->where('user_id', '=', Auth::user()->id)->whereIn('target_id', $queryArray)->get();
				$outputArray=array();
				foreach ($userLikes as $like) {
					$outputArray[]=$like->target_id;
				}

				$response->type="success";
				$response->data=$outputArray;
			} else {
				//User is not logged in
				$response->type="error";
				$response->msg="login_required";
			}
		} else {//Handle invalid input
			$response->type="error";
			$response->msg="invalid_input";
		}

		return Response::json($response);
	}//getSnapLikes()

	public function getLikes() {//Working on a universal solution
		/*
		//Setup response object
		$response=new stdClass();
		$response->type=null;$response->msg=null;$response->data=null;

		//Get input
		$input=Input::only('targets');
		$targets=json_decode($input['targets']);
		*/

		/*Solution 1
		//Rethink about this shit
		if(is_object($target) && property_exists($target, 'target_type') && property_exists($target, 'id_array')) {
			if(in_array($target->target_type, $this->targetTypes)) {
				if(is_array($targets->id_array)) {
					//
				} else {
					//Invalid id_array
					$response->type='error';
					$response->msg='invalid_id_array';
				}
			} else {
				//Invalid targets object
				$response->type='error';
				$response->msg='invalid_target_object';
			}
		}
		*/

		/*Solution 2
		if(is_array($targets)) {
			//Validate
			$validation=true;
			foreach($targets as $target) {
				if(is_object($target) && property_exists($target, 'target_type') && property_exists($target, 'target_id')) {
					if(in_array($target->target_type, $this->targetTypes)) {
						//
					} else {
						//Invalid target_type
						$validation=false;
						break;
					}
				} else {
					//Invalid target object
					$validation=false;
					break;
				}
			}
		}
		*/
	}//getLikes()

}