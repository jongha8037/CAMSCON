<?php

class InspirersPageController extends BaseController {

	public function getList() {
		$users = User::with('profileImage')->with(array('snaps' => function($query) {
			$query->where('status','=','published');
		}))->whereRaw('group_id = 3 or group_id = 8')->orderBy('nickname')->get();
	
		return View::make('front.inspirers.list', ViewData::get())->with('users', $users);
	}
}