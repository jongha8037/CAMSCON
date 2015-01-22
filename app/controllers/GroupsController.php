<?php

class GroupsController extends BaseController {

	public function showUsers($queryType=null,$field=null) {
		$input=Input::only('field', 'query');

		//Get group list
		$groups=Group::orderBy('name', 'ASC')->get();
		ViewData::add('groups', $groups);
		
		$groupIdArray=array(0);
		foreach ($groups as $group) {
			$groupIdArray[]=intval($group->id);
		}

		//Get user count
		$userCount=array();
		$userCount['all']=User::count();
		$userCount['0']=User::where('group_id', '=', 0)->count();
		foreach($groups as $group) {
			$userCount[$group->id]=User::where('group_id', '=', $group->id)->count();
		}
		ViewData::add('userCount', $userCount);

		//Query users
		$users=array();
		if($queryType=='group') {
			$cleanField=intval($field);
			if( in_array($cleanField, $groupIdArray) ) {
				$users=User::with('snaps')->where('group_id', '=', $cleanField)->paginate(30);
			} else {
				App::abort(404);
			}

			ViewData::add('currentGroup', $cleanField);

			if($cleanField===0) {
				$queryDescription='그룹 보기: 일반 사용자';
			} else {
				foreach($groups as $group) {
					if($group->id==$cleanField) {
						$queryDescription=sprintf('그룹 보기: %s', $group->name);
						break;
					}
				}
			}
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

		$users=User::with('groups')->whereIn('id', $checked)->delete();

		return Redirect::back()->with('action_success', '선택한 사용자들이 삭제되었습니다! :)');
	}//deleteUsers()

	public function moveUsers() {
		$input=Input::only('checked', 'group_id');

		$groupsString='0';
		$groups=Group::get();
		foreach($groups as $group) {
			$groupsString.=sprintf(', %s', $group->id);
		}

		$validationRules=array(
			'group_id'=>'required|in:'.$groupsString
		);

		$validator=Validator::make($input, $validationRules);

		if($validator->passes()) {
			$checked=explode(',', $input['checked']);
			$users=User::with('group')->whereIn('id', $checked)->get();

			$groupId=$input['group_id'];
			$users->each(function($user) use($groupId) {
				$user->group_id=$groupId;
				$user->save();
			});

			return Redirect::back()->with('action_success', '선택한 사용자들이 이동되었습니다! :)');
		} else {
			return Redirect::back()->with('action_error', '유효하지 않은 요청 입니다! :(');
		}
	}//moveUsers()

}