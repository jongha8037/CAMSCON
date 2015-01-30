<?php

class SimplePictorial extends Eloquent {

	/*Relations*/
	public function thumbnail() {
		return $this->hasMany('SimplePictorialAttachment', 'pictorial_id')->first();
	}

	public function attachments() {
		return $this->hasMany('SimplePictorialAttachment', 'pictorial_id');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function likes() {
		return $this->morphMany('UserLike', 'target');
	}

	public function liked() {
		if(Auth::check()) {
			return $this->morphMany('UserLike', 'target')->where('user_id', '=', Auth::user()->id);
		} else {
			return $this->morphMany('UserLike', 'target')->where('user_id', '=', 0);
		}
	}

}