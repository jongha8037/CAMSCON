<?php

class StyleIcon extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function primary() {
		return $this->hasOne('IconPrimaryImage');
	}

	public function attachments() {
		return $this->hasOne('IconAttachments');
	}

}