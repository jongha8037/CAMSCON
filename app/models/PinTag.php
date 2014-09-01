<?php

class PinTag extends Eloquent {

	public function target() {
		return $this->morphTo();
	}

	public function links() {
		return $this->hasMany('PinLink', 'pin_id');
	}

	public function brand() {
		return $this->belongsTo('FashionBrand', 'brand_id');
	}

	public function itemCategory() {
		return $this->belongsTo('FashionItemCategory', 'item_id');
	}

}