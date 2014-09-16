<?php

class ProfileCover extends ImageAttachment {

	protected $relative_path='assets/user/profile-covers';

	public function user() {
		return $this->belongsTo('User');
	}

	//Override method for AWS CloudFront
	public function getUrlAttribute() {
		if(isset($this->id,$this->original_extension,$this->dir_path,$this->filename)) {
			return sprintf('http://cdn.camscon.kr/%s/%s.%s', $this->dir_path, $this->filename, $this->original_extension);
		} else {
			return false;
		}
	}//getUrlAttribute()

}