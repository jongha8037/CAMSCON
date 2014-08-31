<?php

class StyleIconController extends BaseController {

	//TODO: Cache queries for front-end
	public function getListAll($slug='all', $ordering='new') {
		if(Route::current()->uri()=='/') {
			$ordering='hot';
		}

		//ViewData::add('fbLoginURL', action('AdminController@loginWithFB'));
		if(Request::ajax()) {
			//
		} else {
			return View::make('front.styleicon.list', ViewData::get());
		}
	}//getListHot()

	public function getListCampus($slug=null, $ordering='new') {
		return View::make('front.styleicon.list');
	}//getListCampus()

	public function getListStreet($slug=null, $ordering='new') {
		return View::make('front.styleicon.list');
	}//getListStreet()

	public function getListBrand($slug=null, $ordering='new') {
		return View::make('front.styleicon.list');
	}//getListCampus()

	public function getSingle($slug=null, $id=null) {
		//
	}//getSingle()

	public function showEditor($id=null) {
		if($id) {
			$icon=StyleIcon::with('primary', 'attachments')->find($id);
		} else {
			$icon=new StyleIcon;
			$icon->user_id=Auth::user()->id;
			$icon->status='draft';
			$icon->save();
		}

		//Get item categories
		$categories=FashionItemCategory::orderBy('id','asc')->get();

		$tree_temp=array();

		foreach($categories as $category) {
			if($category->parent_id==0) {
				$parentElement=new stdClass();
				$parentElement->model=$category;
				$parentElement->children=array();
				$tree_temp[$category->id]=$parentElement;
			}
		}

		foreach($categories as $category) {
			if($category->parent_id!=0) {
				$tree_temp[$category->parent_id]->children[]=$category;
			}
		}

		$tree_output=array();
		foreach ($tree_temp as $element) {
			$tree_output[]=$element;
		}

		ViewData::add('itemCategories', $tree_output);

		if($icon) {
			ViewData::add('icon', $icon);
			return View::make('front.styleicon.editor', ViewData::get());
		} else {
			return Redirect::to('error/not-found');
		}
	}//showEditor()

	public function uploadPrimary() {
		$response=new stdClass;
		$response->type=null;
		$response->data=null;

		//Check StyleIcon existence and ownership
		$input=Input::only('styleicon_id');

		$icon=$this->loadStyleIcon(intval($input['styleicon_id']));
		if($icon) {
			if(Input::hasFile('image')) {
				$img=new IconPrimaryImage;
				try {
					$img->setUploadedFile(Input::file('image'));
					$img->style_icon_id=0;
					$img->restrictWidth(670);

					$oldImg=null;
					if($icon->primary) {
						$oldImg=$icon->primary->id;
					}

					if($icon->primary()->save($img)) {
						if($oldImg) {
							IconPrimaryImage::find($oldImg)->delete();
						}
						$response->type='success';
						$response->data=$img;
					} else {
						throw new Exception("Failed to save file.");
					}
				} catch(Exception $e) {Log::error($e);
					$response->type='error';
					$response->data='file_proc';
				}
			} else {
				$response->type='error';
				$response->data='no_file';
			}
		} else {
			if($icon===null) {
				$response->type='error';
				$response->data='not_found';
			} else {
				$response->type='error';
				$response->data='not_owner';
			}
		}

		return Response::json($response);
	}//uploadPrimary()

	public function uploadAttachment() {
		$response=new stdClass;
		$response->type=null;
		$response->data=null;

		//Check StyleIcon existence and ownership
		$input=Input::only('styleicon_id');

		$icon=$this->loadStyleIcon(intval($input['styleicon_id']));
		if($icon) {
			if(Input::hasFile('image')) {
				$img=new IconAttachment;
				try {
					$img->setUploadedFile(Input::file('image'));
					$img->style_icon_id=0;
					$img->restrictWidth(670);

					if($icon->primary()->save($img)) {
						$response->type='success';
						$response->data=$img;
					} else {
						throw new Exception("Failed to save file.");
					}
				} catch(Exception $e) {Log::error($e);
					$response->type='error';
					$response->data='file_proc';
				}
			} else {
				$response->type='error';
				$response->data='no_file';
			}
		} else {
			if($icon===null) {
				$response->type='error';
				$response->data='not_found';
			} else {
				$response->type='error';
				$response->data='not_owner';
			}
		}

		return Response::json($response);
	}//uploadAttachment()

	public function deleteAttachment() {
		$response=new stdClass;
		$response->type=null;
		$response->data=null;

		//Check StyleIcon existence and ownership
		$input=Input::only('styleicon_id', 'attachment_id');

		$icon=$this->loadStyleIcon(intval($input['styleicon_id']));
		if($icon) {
			$attachment=IconAttachment::find($input['attachment_id']);
			if($attachment) {
				if($attachment->delete()) {
					$response->type='success';
					$response->data=$input['attachment_id'];
				} else {
					$response->type='error';
					$response->data='file_proc';
				}
			} else {
				$response->type='error';
				$response->data='no_attachment';
			}
		} else {
			if($icon===null) {
				$response->type='error';
				$response->data='not_found';
			} else {
				$response->type='error';
				$response->data='not_owner';
			}
		}

		return Response::json($response);
	}

	public function saveStyleIcon($publish=false) {
		//
	}//saveStyleIcon()

	private function getStyleIcon($id=0) {
		//TODO: Cache queries
		$icon=StyleIcon::with('user', 'primary', 'attachments')->find(intval($id));
		if($icon) {
			return $icon;
		} else {
			return null;
		}
	}//getStyleIcon()

	private function loadStyleIcon($id=0) {
		$icon=StyleIcon::with('user', 'primary', 'attachments')->find(intval($id));
		if($icon) {
			if(is_object($icon->user) && (intval($icon->user->id)===intval(Auth::user()->id))) {
				return $icon;
			} else {
				return false;
			}
		} else {
			return null;
		}
	}//getStyleIcon()

}
