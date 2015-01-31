<?php

class SimplePictorial extends Eloquent {

	protected $appends = array('pretty_date');

	/*Relations*/
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

	/*Accessor definitions*/
	public function getPrettyDateAttribute() {
		$time=strtotime($this->created_at);
		$prettyDate=date('y.m.d', $time);
		return $prettyDate;
	}

}