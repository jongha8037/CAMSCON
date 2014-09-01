<?php

class StreetSnapAttachment extends ImageAttachment {

	protected $relative_path='assets/streetsnap/attachments';

	public function snap() {
		return $this->belongsTo('StreetSnap', 'snap_id');
	}

}