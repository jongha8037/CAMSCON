<?php

class InspirersPageController extends BaseController {

	public function getList() {
		$user = User::whereRaw('group_id = 3 or group_id = 8')->orderBy('nickname')->get();

		foreach($user as $users){
			$userid[]=$users->id;
		}

		for($i=0; $i<count($userid); $i++) {
			$result= StreetSnap::where('user_id', '=', $userid[$i])->get();
			foreach ($result as $results) {
				$resultid[]=$results->user_id;
			}
			static $snaplist=array();
			$snaplist[$userid[$i]]=count($resultid);
			$resultid=null;

		}
/*
		foreach (User::with('ProfileImage')->get() as $user){
		    User::find($users->id)->ProfileImage;
		    var_dump($user->ProfileImage->url);
		}
*/
		return View::make('front.inspirers.list', ViewData::get())->with('users', $user)->with('snaplist', $snaplist);

	}
}