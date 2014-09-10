<?php
class LikeController extends BaseController {
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
}