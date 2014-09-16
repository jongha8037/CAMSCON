<?php

class StreetSnapPrimary extends ImageAttachment {

	protected $relative_path='assets/streetsnap/primary';
	protected $table = 'street_snap_primary_images';

	public function snap() {
		return $this->belongsTo('StreetSnap', 'snap_id');
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