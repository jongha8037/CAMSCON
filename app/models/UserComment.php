<?php

class UserComment extends Eloquent {

	public function target() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function children() {
		return $this->hasMany('UserComment', 'parent_id');
	}

	public function parent() {
		return $this->belongsTo('UserComment');
	}

}