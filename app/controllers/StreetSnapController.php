<?php

class StreetSnapController extends BaseController {

	//TODO: Cache queries for front-end
	public function getList($category='all', $slug=null, $ordering='new') {
		if(Route::current()->uri()=='/') {
			$ordering='hot';
		}

		//Get street snaps
		switch($category) {
			case 'all':
				if($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

			case 'campus':
				if($slug=='all') {
					if($ordering=='hot') {
						$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
							->has('primary')
							->where('status', '=', 'published')
							->orderBy('cached_total_likes', 'DESC')
							->orderBy('created_at', 'DESC')
							->paginate(9);
					} else {
						$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
							->has('primary')
							->where('status', '=', 'published')
							->orderBy('created_at', 'DESC')
							->paginate(9);
					}
				} else {
					$meta=CampusMeta::where('slug', '=', $slug)->first();
					if(empty($meta)) {
						App::abort(404);
					} elseif($ordering=='hot') {
						$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
							->where('meta_type', '=', 'CampusMeta')
							->where('meta_id', '=', $meta->id)
							->has('primary')
							->where('status', '=', 'published')
							->orderBy('cached_total_likes', 'DESC')
							->orderBy('created_at', 'DESC')
							->paginate(9);
					} else {
						$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
							->where('meta_type', '=', 'CampusMeta')
							->where('meta_id', '=', $meta->id)
							->has('primary')
							->where('status', '=', 'published')
							->orderBy('created_at', 'DESC')
							->paginate(9);
					}
				}
				break;

			case 'street':
				$meta=StreetMeta::where('slug', '=', $slug)->first();
				if(empty($meta)) {
					App::abort(404);
				} elseif($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'StreetMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'StreetMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

			case 'brand':
				$brand=FashionBrand::where('slug', '=', $slug)->first();
				if(empty($brand)) {
					App::abort(404);
				} elseif($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->whereHas('pins', function($q) use($brand) {
							$q->where('brand_id', '=', $brand->id);
						})
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->whereHas('pins', function($q) use($brand) {
							$q->where('brand_id', '=', $brand->id);
						})
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

				case 'fashion-week':
				$meta=FashionWeekMeta::where('slug', '=', $slug)->first();
				if(empty($meta)) {
					App::abort(404);
				} elseif($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'FashionWeekMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'FashionWeekMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

				case 'festival':
				$meta=FestivalMeta::where('slug', '=', $slug)->first();
				if(empty($meta)) {
					App::abort(404);
				} elseif($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'FestivalMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'FestivalMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

				case 'club':
				$meta=ClubMeta::where('slug', '=', $slug)->first();
				if(empty($meta)) {
					App::abort(404);
				} elseif($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'ClubMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('meta_type', '=', 'ClubMeta')
						->where('meta_id', '=', $meta->id)
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

				case 'men':
				if($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('gender', '=', 'male')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('gender', '=', 'male')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
				break;

				case 'ladies':
				if($ordering=='hot') {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('gender', '=', 'female')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('cached_total_likes', 'DESC')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				} else {
					$snaps=StreetSnap::with('user.profileImage', 'primary', 'meta')
						->where('gender', '=', 'female')
						->has('primary')
						->where('status', '=', 'published')
						->orderBy('created_at', 'DESC')
						->paginate(9);
				}
		}//Switch()
		//Add context to snaps
		$snaps->each(function($snap) use($category, $slug) {
			$snap->setContext($category, $slug);
		});
		ViewData::add('snaps', $snaps->toJson());

		//Set pagination endpoint
		$nextPage=null;
		$currentPage=$snaps->getCurrentPage();
		if($currentPage<$snaps->getLastPage()) {
			$nextPage=action('StreetSnapController@getListAll', array('category'=>$category, 'slug'=>$slug, 'ordering'=>$ordering, 'page'=>$currentPage+1));
		}
		ViewData::add('loadMore', $nextPage);

		//Return response
		if(Request::ajax()) {
			//return '{"snaps":'.$snaps->toJson().',"more_url":"'.$nextPage.'"}';
			return sprintf('{"snaps":%s,"more_url":"%s"}', $snaps->toJson(), $nextPage);
		} else {
			return View::make('front.streetsnap.list', ViewData::get());
		}
	}//getList()

	public function getSingle($category=null, $slug=null, $id=null) {
		//Breadcrumbs
		$breadcrumbs=array();
		$breadcrumbs[]=array('name'=>'전체보기(View all)', 'url'=>url('/'));
		if($category=='filter') {
			$breadcrumbs[]=array('name'=>strtoupper($slug), 'url'=>action('StreetSnapController@getList', array('category'=>$slug)));
		} else {
			$breadcrumbs[]=array('name'=>strtoupper($category), 'url'=>action('StreetSnapController@getList', array('category'=>$category)));
		}			

		if( $category=='brand' ) {
			$brand=FashionBrand::where('slug', '=', $slug)->first();
			if($brand) {
				$breadcrumbs[]=array('name'=>strtoupper($brand->name), 'url'=>action('StreetSnapController@getList', array('category'=>$category, 'slug'=>$slug)));
				
				$snap=StreetSnap::with('user', 'user.profileImage', 'primary', 'attachments', 'pins', 'pins.links', 'pins.brand', 'pins.itemCategory', 'pins.itemCategory.parent', 'meta')
					->where('id', '=', $id)
					->whereHas('pins', function($q) use($brand) {
						$q->where('brand_id', '=', $brand->id);
					})
					->first();

				if($snap) {
					$prevSnap=StreetSnap::whereHas('pins', function($q) use($brand) {
						$q->where('brand_id', '=', $brand->id);
					})->where('status', '=', 'published')->where('id', '<', $snap->id)->max('id');

					$nextSnap=StreetSnap::whereHas('pins', function($q) use($brand) {
						$q->where('brand_id', '=', $brand->id);
					})->where('status', '=', 'published')->where('id', '>', $snap->id)->min('id');
				} else {
					App::abort(404);
				}
			} else {
				//404
				App::abort(404);
			}
		} elseif( $category=='filter' && ($slug=='men' || $slug=='ladies') ) {
			$termMapper=array('men'=>'male', 'ladies'=>'female');
			$snap=StreetSnap::with('user', 'user.profileImage', 'primary', 'attachments', 'pins', 'pins.links', 'pins.brand', 'pins.itemCategory', 'pins.itemCategory.parent', 'meta')
				->where('id', '=', $id)
				->where('gender', '=', $termMapper[$slug])
				->first();
			if($snap) {
				$prevSnap=StreetSnap::where('gender', '=', $termMapper[$slug])->where('status', '=', 'published')->where('id', '<', $snap->id)->max('id');
				$nextSnap=StreetSnap::where('gender', '=', $termMapper[$slug])->where('status', '=', 'published')->where('id', '>', $snap->id)->min('id');
			} else {
				App::abort(404);
			}
		} else {
			$snap=StreetSnap::with('user', 'user.profileImage', 'primary', 'attachments', 'pins', 'pins.links', 'pins.brand', 'pins.itemCategory', 'pins.itemCategory.parent', 'meta')->find($id);
			if($snap && strtolower($snap->meta_type)==$category.'meta') {
				$breadcrumbs[]=array('name'=>strtoupper($snap->meta->name), 'url'=>action('StreetSnapController@getList', array('category'=>$category, 'slug'=>$slug)));
				$prevSnap=StreetSnap::where('meta_type', '=', $snap->meta_type)->where('meta_id', '=', $snap->meta_id)->where('status', '=', 'published')->where('id', '<', $snap->id)->max('id');
				$nextSnap=StreetSnap::where('meta_type', '=', $snap->meta_type)->where('meta_id', '=', $snap->meta_id)->where('status', '=', 'published')->where('id', '>', $snap->id)->min('id');
			} else {
				App::abort(404);
			}
		}
		ViewData::add('breadcrumbs', $breadcrumbs);
		ViewData::add('snap', $snap);
		ViewData::add('category', $category);
		ViewData::add('slug', $slug);
		ViewData::add('prevSnap', $prevSnap);
		ViewData::add('nextSnap', $nextSnap);

		return View::make('front.streetsnap.single', ViewData::get());
	}//getSingle()

}
