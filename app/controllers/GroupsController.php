<?php

class GroupsController extends BaseController {

	public function showUsers($queryType=null,$field=null) {
		$input=Input::only('field', 'query');

		//Get group list
		$groups=Group::get();
		ViewData::add('groups', $groups);

		//Get user count
		$userCount=array();
		$userCount['all']=User::count();
		$userCount[0]=User::where('group_id', '=', 0)->count();
		foreach($groups as $group) {
			$userCount[$group->id]=User::where('group_id', '=', $group->id)->count();
		}
		ViewData::add('userCount', $userCount);

		//Query users
		$users=array();
		if($queryType=='group') {
			$cleanField=intval($field);
			if( array_key_exists($cleanField, $groups) ) {
				$users=User::with('snaps')->where('group_id', '=', intval($cleanField))->paginate(30);
			} else {
				App::abort(404);
			}

			ViewData::add('currentGroup', $cleanField);

			$queryDescription=sprintf('그룹 보기: %s', $queryGroup->name);
		} elseif( $queryType=='search' && in_array( $input['field'], array('email', 'nickname') ) ) {
			if(!empty($_GET['query'])) {
				$users=User::with('snaps')->where($input['field'], 'LIKE', '%'.$input['query'].'%')->paginate(30);
			}

			if($input['field']=='email') {
				$queryDescription=sprintf('이메일 검색: %s', $input['query']);
			} elseif ($_GET['field']=='nickname') {
				$queryDescription=sprintf('닉네임 검색: %s', $input['query']);
			}
		} else {
			$users=User::paginate(30);
			$queryDescription='전체보기';
		}
		ViewData::add('users', $users);
		ViewData::add('queryDescription', $queryDescription);

		return View::make('admin.users.groups', ViewData::get());
	}//showUsers()

	public function deleteUsers() {
		$input=Input::only('checked');
		$checked=explode(',', $input['checked']);
		$users=User::with('groups')->whereIn('id', $checked)->get();

		foreach($users as $user) {
			DB::table('groupings')->where('user_id','=',$user->id)->delete();
			$user->delete();
		}

		return Redirect::back()->with('action_success', '선택한 사용자들이 삭제되었습니다! :)');
	}//deleteUsers()

	public function copyUsers() {
		$input=Input::only('checked', 'group_id');

		$validationRules=array(
			'group_id'=>'required|exists:groups,id'
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$checked=explode(',', $input['checked']);
			$users=User::with('groups')->whereIn('id', $checked)->get();

			foreach($users as $user) {
				$user->groups()->attach($input['group_id']);
			}

			return Redirect::back()->with('action_success', '선택한 사용자들이 복사되었습니다! :)');
		} else {
			return Redirect::back()->with('action_error', '유효하지 않은 요청 입니다! :(');
		}
	}//copyUsers()

	public function moveUsers() {
		$input=Input::only('checked', 'group_id', 'current_group');

		$validationRules=array(
			'group_id'=>'required|exists:groups,id',
			'current_group'=>'required|exists:groups,id'
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$checked=explode(',', $input['checked']);
			$users=User::with('groups')->whereIn('id', $checked)->get();

			foreach($users as $user) {
				$user->groups()->detach($input['current_group']);
				$user->groups()->attach($input['group_id']);
			}

			return Redirect::back()->with('action_success', '선택한 사용자들이 이동되었습니다! :)');
		} else {
			return Redirect::back()->with('action_error', '유효하지 않은 요청 입니다! :(');
		}
	}//moveUsers()

	public function showUsersOld($queryType=null,$field=null) {
		//Get group list
		$groups=Group::get();
		ViewData::add('groups', $groups);

		//Get user count
		$userCount=array();
		$userCount['all']=User::count();
		foreach($groups as $group) {
			$userCount[$group->id]=User::whereHas('groups', function($q) use($group) {
				$q->where('groups.id', '=', $group->id);
			})->count();
		}
		ViewData::add('userCount', $userCount);

		//Query users
		$users=array();
		$queryDescription=null;
		if($queryType=='group') {
			$queryGroup=null;
			foreach($groups as $group) {
				if(intval($group->id)===intval($field)) {
					$queryGroup=$group;
					break;
				}
			}
			if($queryGroup) {
				$users=User::with('snaps')->whereHas('groups', function($q) use($queryGroup) {
					$q->where('groups.id', '=', $queryGroup->id);
				})->paginate(30);
			}

			ViewData::add('currentGroup', $queryGroup->id);

			$queryDescription=sprintf('그룹 보기: %s', $queryGroup->name);
		} elseif( $queryType=='search' && in_array( $_GET['field'], array('email', 'nickname') ) ) {
			if(!empty($_GET['query'])) {
				$users=User::with('snaps')->where($_GET['field'], 'LIKE', '%'.$_GET['query'].'%')->paginate(30);
			}

			if($_GET['field']=='email') {
				$queryDescription=sprintf('이메일 검색: %s', $_GET['query']);
			} elseif ($_GET['field']=='nickname') {
				$queryDescription=sprintf('닉네임 검색: %s', $_GET['query']);
			}
		} else {
			$users=User::paginate(30);
			$queryDescription='전체보기';
		}
		ViewData::add('users', $users);
		ViewData::add('queryDescription', $queryDescription);

		return View::make('admin.users.groups', ViewData::get());
	}//showUsersOld()

}