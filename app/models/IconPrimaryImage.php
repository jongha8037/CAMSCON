<?php

class IconPrimaryImage extends ImageAttachment {

	protected $relative_path='assets/styleicon/primary';

	public function icon() {
		return $this->belongsTo('StyleIcon');
	}

}