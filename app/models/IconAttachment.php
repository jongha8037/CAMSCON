<?php

class IconAttachment extends ImageAttachment {

	protected $relative_path='assets/icon/attachments';

	public function icon() {
		return $this->belongsTo('StyleIcon');
	}

}