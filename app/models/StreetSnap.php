<?php

class StreetSnap extends Eloquent {

	protected $visible=array('id', 'name', 'affiliation', 'cached_total_likes', 'cached_total_comments', 'user', 'primary', 'meta', 'single_url');
	protected $appends=array('single_url');
	protected $category;
	protected $slug;

	public function user() {
		return $this->belongsTo('User');
	}

	public function primary() {
		return $this->hasOne('StreetSnapPrimary', 'snap_id');
	}

	public function attachments() {
		return $this->hasMany('StreetSnapAttachment', 'snap_id');
	}

	public function pins() {
		return $this->morphMany('PinTag', 'target');
	}

	public function meta() {
		return $this->morphTo();
	}

	public function setContext($category=null, $slug=null) {
		$this->category=$category;
		$this->slug=$slug;
		return $this;
	}

	/*
	public function myLike() {
		return $this->hasOne('Like', '');
	}
	*/

	/*
	public function pinlinks() {
		return $this->hasManyThrough('PinLink', 'PinTag', null, 'pin_id');
	}
	*/

	public function getSingleUrlAttribute() {
		if($this->category=='all') {
			$metaCategory=array(
				'CampusMeta'=>'campus',
				'ClubMeta'=>'club',
				'FashionWeekMeta'=>'fashion-week',
				'FestivalMeta'=>'festival',
				'StreetMeat'=>'street'
			);

			return action('StreetSnapController@getSingle', array('category'=>$metaCategory[$this->meta_type], 'slug'=>$this->meta->slug, 'id'=>$this->id));
		} elseif($this->category=='men' || $this->category=='ladies') {
			return action('StreetSnapController@getSingle', array('category'=>'filter', 'slug'=>$this->category, 'id'=>$this->id));
		} else {
			return action('StreetSnapController@getSingle', array('category'=>$this->category, 'slug'=>$this->slug, 'id'=>$this->id));
		}
	}

}