<?php

class PinTag extends Eloquent {

	public function target() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsTo('User');
	}

}