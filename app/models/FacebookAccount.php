<?php

class FacebookAccount extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

}