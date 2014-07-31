<?php

class FashionItemCategory extends Eloquent {

	protected $table = 'fashion_item_categories';
	protected $appends = array('name');

	//Accessor for name
	//sets name to match locale (defaults to name_en)
	public function getNameAttribute() {
		$name=null;
		$locale=App::getLocale();
		switch($locale) {
			case 'ko':
				$name=$this->name_ko;
				break;
			case 'ja':
				$name=$this->name_ja;
				break;
			case 'zh_cn':
				$name=$this->name_zh_cn;
				break;
			case 'zh_tw':
				$name=$this->name_zh_cn;
				break;
			case 'ru':
				$name=$this->name_ru;
				break;
			case 'th':
				$name=$this->name_th;
				break;
			case 'es':
				$name=$this->name_es;
				break;
			case 'vi':
				$name=$this->name_vi;
				break;
			default:
				$name=$this->name_en;
				break;
		}

		if($name) {
			return $name;
		} else {
			return $this->name_en;
		}
	}//getNameAttribute

}