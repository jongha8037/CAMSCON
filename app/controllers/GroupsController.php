<?php

class GroupsController extends BaseController {

	public function showUsers($queryType=null,$field=null) {
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
				$users=User::whereHas('groups', function($q) use($queryGroup) {
					$q->where('groups.id', '=', $queryGroup->id);
				})->paginate(30);
			}

			ViewData::add('currentGroup', $queryGroup->id);

			$queryDescription=sprintf('그룹 보기: %s', $queryGroup->name);
		} elseif( $queryType=='search' && in_array( $_GET['field'], array('email', 'nickname') ) ) {
			if(!empty($_GET['query'])) {
				$users=User::where($_GET['field'], 'LIKE', '%'.$_GET['query'].'%')->paginate(30);
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
	}//showUsers()

	public function deleteUsers() {
		$input=Input::only('checked');
		$checked=explode(',', $input['checked']);
		$users=User::whereIn('id', $checked)->get();

		foreach($users as $user) {
			$user->delete();
		}

		return Redirect::back()->with('action_success', 'delete');
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

			return Redirect::back()->with('action_success', 'copy');
		} else {
			return Redirect::back()->with('action_error', 'copy_invalid_request');
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

			return Redirect::back()->with('action_success', 'move');
		} else {
			return Redirect::back()->with('action_error', 'move_invalid_request');
		}
	}//moveUsers()

}