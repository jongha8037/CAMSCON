<?php
class InspirersPageController extends BaseController {
	public function showList() {
		$users = User::with('profileImage')->with(array('snaps' => function($query) {
			$query->where('status','=','published');
		}))->Where('group_id', '=', 3)
		->orWhere('group_id', '=', 8)
		->orderBy('nickname')->get();

		ViewData::add('users', $users);
		return View::make('front.inspirers.list', ViewData::get());
	}
}
