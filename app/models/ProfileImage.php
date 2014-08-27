<?php

class ProfileImage extends ImageAttachment {

	protected $relative_path='user-assets/profile-images';

	public function user() {
		return $this->belongsTo('User');
	}

}