<?php

class StreetSnap extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function primary() {
		return $this->hasOne('StreetSnapPrimary', 'snap_id');
	}

	public function attachments() {
		return $this->hasMany('StreetSnapAttachment', 'snap_id');
	}

	public function pins() {
		return $this->morphMany('PinTag', 'target');
	}

	public function meta() {
		return $this->morphTo();
	}

	/*
	public function pinlinks() {
		return $this->hasManyThrough('PinLink', 'PinTag', null, 'pin_id');
	}
	*/

}