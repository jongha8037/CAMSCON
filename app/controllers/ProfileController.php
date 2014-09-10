<?php
class ProfileController extends BaseController {

	public function showProfile($id) {
		if(strval(intval($id))==$id) {
			//Get profile by id
			$profile=User::find($id);
		} else {
			//Get profile by uri
			$profile=User::where('uri', '=', $id)->first();
		}

		if($profile) {
			{{$profile}}
		} else {
			App::abort(404);
		}
	}
	
}
?>