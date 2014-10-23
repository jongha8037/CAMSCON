<?php

class BlogMeta extends Eloquent {

	protected $table = 'blog_meta';

	public function snap() {
		return $this->morphMany('StreetSnap', 'meta');
	}

}