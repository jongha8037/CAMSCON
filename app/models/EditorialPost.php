<?php

class EditorialPost extends Eloquent {

	/*Relations*/

	public function category() {
		return $this->belongsTo('EditorialCategory', 'category_id');
	}

	public function thumbnail() {
		return $this->hasOne('EditorialThumbnail', 'post_id');
	}

	public function content() {
		return $this->morphTo();
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