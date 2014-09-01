<?php

class PinLink extends Eloquent {

	public function pin() {
		return $this->belongsTo('PinTag', 'pin_id');
	}

}