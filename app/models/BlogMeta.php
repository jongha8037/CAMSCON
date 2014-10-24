<?php

class BlogMeta extends Eloquent {

	protected $table = 'blog_meta';
	protected $appends=array('country');

	public function snap() {
		return $this->morphMany('StreetSnap', 'meta');
	}

	public function getCountryAttribute() {
		return trans('countries.'.$this->country_code);
	}

}