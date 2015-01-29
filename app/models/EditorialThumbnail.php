<?php

class EditorialThumbnail extends ImageAttachment {

	protected $relative_path='assets/editorials/thumbnails';

	public function post() {
		return $this->belongsTo('EditorialPost', 'post_id');
	}

	//Override method for AWS CloudFront
	public function getUrlAttribute() {
		if(isset($this->id,$this->original_extension,$this->dir_path,$this->filename)) {
			return sprintf('http://cdn.camscon.kr/%s/%s.%s', $this->dir_path, $this->filename, $this->original_extension);
			//return asset(sprintf('%s/%s.%s', $this->dir_path, $this->filename, $this->original_extension));
		} else {
			return false;
		}
	}//getUrlAttribute()

}