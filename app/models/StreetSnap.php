<?php

class StreetSnap extends Eloquent {

	protected $visible=array('id', 'name', 'affiliation', 'meta_type', 'cached_total_likes', 'cached_total_comments', 'user', 'primary', 'meta', 'single_url', 'snap_title', 'likes', 'liked');
	protected $appends=array('single_url', 'snap_title');
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

	public function likes() {
		return $this->morphMany('UserLike', 'target');
	}

	public function comments() {
		return $this->morphMany('UserComment', 'target');
	}

	public function liked() {
		if(Auth::check()) {
			return $this->morphMany('UserLike', 'target')->where('user_id', '=', Auth::user()->id);
		} else {
			return $this->morphMany('UserLike', 'target')->where('user_id', '=', 0);
		}
	}

	public function getSingleUrlAttribute() {
		if($this->category=='all' || $this->category=='profile' || $this->category=='single') {
			$metaCategory=array(
				'CampusMeta'=>'campus',
				'ClubMeta'=>'club',
				'FashionWeekMeta'=>'fashion-week',
				'FestivalMeta'=>'festival',
				'StreetMeta'=>'street',
				'BlogMeta'=>'blog',
				'MagazineMeta'=>'magazine'
			);

			return action('StreetSnapController@getSingle', array('category'=>$metaCategory[$this->meta_type], 'slug'=>$this->meta->slug, 'id'=>$this->id));
		} elseif($this->category=='men' || $this->category=='ladies') {
			return action('StreetSnapController@getSingle', array('category'=>'filter', 'slug'=>$this->category, 'id'=>$this->id));
		} else {
			return action('StreetSnapController@getSingle', array('category'=>$this->category, 'slug'=>$this->slug, 'id'=>$this->id));
		}
	}

	public function getSnapTitleAttribute() {
		$title=null;

		if(empty($this->meta_type)) {
			$title=$this->name;
		} elseif($this->meta_type=='CampusMeta') {
			/* {CampusName} {Major?} {IconName} */
			$title.=' '.$this->meta->name;
			if($this->affiliation) {
				$title.=' '.$this->affiliation;
			}
			$title.=' '.$this->name;
		} else {
			/* {IconName} {Profession?} @{MetaName} */
			$title.=' '.$this->name;
			if($this->affiliation) {
				$title.=' '.$this->affiliation;
			}
			$title.=' @'.$this->meta->name;
		}

		return $title;
	}

	public function getDescriptionAttribute() {
		$description=null;//Set default value
		if($this->photographer_comment) {
			$description=$this->photographer_comment;
		}

		return $description;
	}

	public function getPrettyDraftTitleAttribute() {
		//
	}

}