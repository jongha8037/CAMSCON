@extends('admin.layouts.admin-master')

@section('head_title')
Inspirer Registration Forms - CAMSCON
@stop

@section('head_styles')
<style type="text/css">
.registration-forms td, 
.registration-forms th {
	text-align: center;
}

.list-filters {
	list-style-type: none;
	margin:0;
	padding:0;
	float:left;
}

.list-filters li {
	float:left;
	margin-right:20px;
	padding:7px 0px;
}

.list-filters li.active {
	font-weight: 700;
}

.toolbar {
	margin-top:60px;
}

.toolbar .filter-title {
	float:left;
	margin:0px 20px 0px 0px;
	padding:7px 0px;
}

.toolbar .action-tool {
	float:right;
}

#toggleChecked {
	cursor:pointer;

	-webkit-transition: color 200ms ease-out;
	-moz-transition: color 200ms ease-out;
	-o-transition: color 200ms ease-out;
	transition: color 200ms ease-out;
}

#toggleChecked:active {
	color:#56d8d1;
}

.pagination-wrapper {
	text-align: center;
}
</style>
@stop

@section('content')
@if(Session::has('affectedRows'))
<div class="alert alert-info">
	<strong>처리 결과:</strong> {{Session::get('affectedRows')}}건 변경됨.
</div>
@endif

<h1>Inspirer Registration 관리</h1>

<div class="toolbar clearfix">
	<label class="filter-title">필터</label>

	<ul class="list-filters clearfix">
		<li class="@if($status=='pending_approval'){{'active'}}@endif">
			<a href="{{action('InspirerRegisterController@showAdmin')}}">승인 대기</a>
		</li>
		<li class="@if($status=='approved'){{'active'}}@endif">
			<a href="{{action('InspirerRegisterController@showAdmin', array('status'=>'approved'))}}">승인됨</a>
		</li>
		<li class="@if($status=='declined'){{'active'}}@endif">
			<a href="{{action('InspirerRegisterController@showAdmin', array('status'=>'declined'))}}">거절됨</a>
		</li>
	</ul>

	<div class="action-tool">
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				선택한 신청서들을... <span class="caret"></span>
			</button>
			<ul id="actionList" class="dropdown-menu" role="menu">
				<li><a href="{{action('InspirerRegisterController@changeStatus', 'pending_approval')}}">승인 대기 상태로 변경</a></li>
				<li><a href="{{action('InspirerRegisterController@changeStatus', 'approved')}}">승인 상태로 변경</a></li>
				<li><a href="{{action('InspirerRegisterController@changeStatus', 'declined')}}">거절 상태로 변경</a></li>
				<li class="divider"></li>
				<li><a href="{{action('InspirerRegisterController@deleteForms', array('status'=>$status))}}">삭제</a></li>
			</ul>
		</div>
	</div>

	{{ Form::open(array('id'=>'actionForm')) }}
		<input type="hidden" id="actionFormData" name="checked" />
	{{ Form::close() }}
</div>

<table id="registrationFormList" class="table registration-forms">
	<thead>
		<tr>
			<th><span id="toggleChecked" class="glyphicon glyphicon-ok"></span></th>
			<th>이름</th>
			<th>닉네임</th>
			<th>휴대전화번호</th>
			<th>이메일</th>
			<th>웹사이트</th>
			<th>블로그</th>
			<th>페이스북</th>
			<th>인스타그램</th>
			<th>캠스콘 계정 정보</th>
		</tr>
	</thead>
	<tbody>
		@foreach($forms as $form)
		<tr>
			<td><input type="checkbox" value="{{$form->id}}" /></td>
			<td>{{{$form->name}}}</td>
			<td>{{{$form->nickname}}}</td>
			<td>{{{$form->mobile}}}</td>
			<td>{{{$form->email}}}</td>
			<td>{{{$form->website}}}</td>
			<td>{{{$form->blog}}}</td>
			<td>{{{$form->facebook}}}</td>
			<td>{{{$form->instagram}}}</td>
			<td>{{{$form->camscon_id}}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@if(is_object($forms))
<div class="pagination-wrapper">{{$forms->links()}}</div>
@endif

@stop

@section('footer_scripts')
<script type="text/javascript">
(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		module.objx.actionForm=$('#actionForm');
		module.objx.actionFormInput=module.objx.actionForm.find('#actionFormData');
		module.objx.actionList=$('#actionList');
		module.objx.formTable=$('#registrationFormList');
		module.objx.toggleCheckedBtn=$('#toggleChecked');

		module.objx.actionList.on('click', 'a', {postAction:module.postAction.bind(module)}, function(e) {
			e.preventDefault();
			e.data.postAction($(this).attr('href'));
		});

		module.objx.toggleCheckedBtn.on('click', null, {toggleAction:module.toggleChecked.bind(module)}, function(e) {
			e.data.toggleAction();
		});
	});
})(window, document, jQuery, {
	/*Inspirer Registration Forms Admin module*/
	objx:{
		actionForm:null,
		actionFormInput:null,
		actionList:null,
		formTable:null,
		toggleCheckedBtn:null
	},
	postAction:function(url) {
		this.objx.actionForm.prop('action', url);
		this.objx.actionFormInput.val(JSON.stringify(this._collectChecked()));
		this.objx.actionForm.submit();
	},
	_collectChecked:function() {
		var collection=[];
		this.objx.formTable.find('input:checked').each(function() {
			collection.push($(this).val());
		});
		return collection;
	},
	toggleChecked:function() {
		this.objx.formTable.find('input').each(function() {
			$(this).prop('checked', !$(this).prop('checked'));
		});
	}
});
</script>
@stop