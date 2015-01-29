<?php

class SimplePictorial extends Eloquent {

	/*Relations*/
	public function post() {
		return $this->morphMany('EditorialPost', 'content');
	}

	public function attachments() {
		return $this->hasMany('SimplePictorialAttachment', 'pictorial_id');
	}

}