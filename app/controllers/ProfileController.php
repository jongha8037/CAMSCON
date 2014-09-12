<?php
class ProfileController extends BaseController {

	public function showProfile($id) {
		if(strval(intval($id))===$id) {
			//Get profile by id
			$profile=User::with('profileImage', 'profileCover')->find($id);
		} else {
			//Get profile by slug
			$profile=User::with('profileImage', 'profileCover')->where('slug', '=', $id)->first();
		}

		if($profile) {
			ViewData::add('profile', $profile);

			//Get stats
			$stats=new stdClass();
			$stats->posts=$profile->snaps()->where('status', '=', 'published')->count();
			$stats->likes=0;
			$stats->comments=0;
			ViewData::add('stats', $stats);

			//Get snaps
			/*
			$snaps=$profile->snaps()->with('user.profileImage', 'primary', 'meta', 'liked')->where('status', '=', 'published')->paginate(9);
			$mySnaps=$profile->snaps()->with('user.profileImage', 'primary', 'meta', 'liked')->where('status', '=', 'published')->paginate(9);
			$likedSnaps=StreetSnap::with('user.profileImage', 'primary', 'meta', 'liked')->whereHas('likes', function($q) {
				$q->where('user_id', '=', Auth::user()->id);
			})->paginate(9);
			ViewData::add('snaps', $snaps->toJson());
			*/

			//Load more url
			$loadMine=null;
			$loadLiked=null;
			ViewData::add('loadMore', $loadMore);

			return View::make('front.user.profile', ViewData::get());
		} else {
			App::abort(404);
		}
	}

	public function showEditor() {
		$profile=User::with('profileImage', 'profileCover')->find(Auth::user()->id);
		ViewData::add('profile', $profile);
		return View::make('front.user.editor', ViewData::get());
	}

	public function uploadCover() {
		$response=new stdClass;
		$response->type=null;
		$response->data=null;

		if(Input::hasFile('image')) {
			$img=new ProfileCover;
			try {
				$img->setUploadedFile(Input::file('image'));
				$img->restrictWidth(1170);

				if($img->width<1170) {
					throw new Exception('Image width is too small.', 501);
				}

				$oldImg=null;
				if(Auth::user()->profileCover) {
					$oldImg=Auth::user()->profileCover->id;
				}

				if(Auth::user()->profileCover()->save($img)) {
					if($oldImg) {
						$oldCover=ProfileCover::find($oldImg);
						$oldCover->delete();
					}
					$response->type='success';
					$response->data=$img;
				} else {
					throw new Exception("Failed to save file.");
				}
			} catch(Exception $e) {Log::error($e);
				switch($e->getCode()) {
					case 501:
						$response->type='error';
						$response->data='image_width';
						break;
					default:
						$response->type='error';
						$response->data='file_proc';
				}//switch()
			}
		} else {
			$response->type='error';
			$response->data='no_file';
		}

		return Response::json($response);
	}

	public function uploadProfile() {
		$response=new stdClass;
		$response->type=null;
		$response->data=null;

		if(Input::hasFile('image')) {
			$img=new ProfileImage;
			try {
				$img->setUploadedFile(Input::file('image'));
				$img->restrictWidth(200);

				if($img->width!==$img->height || ($img->width<200 || $img->height<200)) {
					throw new Exception('Image size error.', 501);
				}

				$oldImg=null;
				if(Auth::user()->profileImage) {
					$oldImg=Auth::user()->profileImage->id;
				}

				if(Auth::user()->profileImage()->save($img)) {
					if($oldImg) {
						$oldImage=ProfileImage::find($oldImg);
						$oldImage->delete();
					}
					$response->type='success';
					$response->data=$img;
				} else {
					throw new Exception("Failed to save file.");
				}
			} catch(Exception $e) {Log::error($e);
				switch($e->getCode()) {
					case 501:
						$response->type='error';
						$response->data='image_size';
						break;
					default:
						$response->type='error';
						$response->data='file_proc';
				}//switch()
			}
		} else {
			$response->type='error';
			$response->data='no_file';
		}

		return Response::json($response);
	}

	public function saveProfile() {
		$user=Auth::user();

		$input=array();
		$validationRules=array();
		$messages=array(
			'required'=>'required',
			'min'=>'min',
			'unique'=>'unique',
			'email'=>'email',
			'confirmed'=>'confirmed',
			'regex'=>'regex',
			'max'=>'max',
			'url'=>'url'
		);

		if(Input::has('nickname')) {
			$input['nickname']=Input::get('nickname');
			$validationRules['nickname']=array('required', 'min:3', 'unique:users,nickname');
			$user->nickname=$input['nickname'];
		}

		if(Input::has('email')) {
			$input['email']=Input::get('email');
			$validationRules['email']=array('required', 'email', 'unique:users,email');
			$user->email=$input['email'];
		}

		if(Input::has('password')) {
			$input['password']=Input::get('password');
			$input['password_confirmation']=Input::get('password_confirmation');
			$validationRules['password']=array('required', 'min:8', 'confirmed');
			$user->password=$input['password'];
		}
		
		if(Input::has('slug')) {
			$input['slug']=Input::get('slug');
			$validationRules['slug']=array('required', 'min:4', 'regex:/^[A-Za-z-_]+$/');
			$user->slug=$input['slug'];
		}

		if(Input::has('instagram')) {
			$input['instagram']=Input::get('instagram');
			$validationRules['instagram']=array('required', 'max:30', 'regex:/^[A-Za-z0-9_]+$/');
			$user->instagram=$input['instagram'];
		}

		if(Input::has('blog')) {
			$input['blog']=Input::get('blog');
			$validationRules['blog']=array('required', 'max:256', 'url');
			$user->blog=$input['blog'];
		}

		$validator=Validator::make($input, $validationRules, $messages);

		if($validator->passes()) {
			if($user->save()) {
				return Redirect::back()->with('profile_save', true);
			} else {
				Input::flash();
				return Redirect::back()->with('profile_error', 'db_error');
			}
		} else {
			Input::flash();
			return Redirect::back()->with('profile_error', 'validation')->withErrors($validator);
		}
	}
	
}
?>