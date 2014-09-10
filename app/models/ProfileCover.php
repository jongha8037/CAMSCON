<?php

class ProfileCover extends ImageAttachment {

	protected $relative_path='assets/user/profile-covers';

	public function user() {
		return $this->belongsTo('User');
	}

}