<?php
class ProfileController extends BaseController {

	public function showProfile($id) {
		if(strval(intval($id))==$id) {
			//Get profile by id
			$profile=User::with('profileImage', 'snaps')->find($id);
		} else {
			//Get profile by uri
			$profile=User::with('profileImage', 'snaps')->where('uri', '=', $id)->first();
		}

		if($profile) {
			ViewData::add('profile', $profile);
			$stats=new stdClass();
			$stats->posts=$profile->snaps->count();
			$stats->likes=0;
			$stats->comments=0;
			ViewData::add('stats', $stats);
			return View::make('front.user.profile', ViewData::get());
		} else {
			App::abort(404);
		}
	}
	
}
?>