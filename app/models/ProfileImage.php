<?php

class ProfileImage extends ImageAttachment {

	protected $relative_path='user/profile-images';

	public function user() {
		return $this->belongsTo('User');
	}

}