<?php

class StreetSnapController extends BaseController {

	//TODO: Cache queries for front-end
	public function getListAll($slug='all', $ordering='new') {
		if(Route::current()->uri()=='/') {
			$ordering='hot';
		}

		//ViewData::add('fbLoginURL', action('AdminController@loginWithFB'));
		if(Request::ajax()) {
			//
		} else {
			return View::make('front.streetsnap.list', ViewData::get());
		}
	}//getListHot()

	public function getListCampus($slug=null, $ordering='new') {
		return View::make('front.streetsnap.list');
	}//getListCampus()

	public function getListStreet($slug=null, $ordering='new') {
		return View::make('front.streetsnap.list');
	}//getListStreet()

	public function getListBrand($slug=null, $ordering='new') {
		return View::make('front.streetsnap.list');
	}//getListCampus()

	public function getSingle($slug=null, $id=null) {
		//
	}//getSingle()

}
