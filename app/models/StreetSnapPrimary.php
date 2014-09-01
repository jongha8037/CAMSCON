<?php

class StreetSnapPrimary extends ImageAttachment {

	protected $relative_path='assets/streetsnap/primary';
	protected $table = 'street_snap_primary_images';

	public function snap() {
		return $this->belongsTo('StreetSnap', 'snap_id');
	}

}