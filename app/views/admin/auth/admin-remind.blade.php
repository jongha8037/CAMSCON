@extends('admin.layouts.admin-master')

@section('head_title')
비밀번호 재설정 요청
@stop

@section('head_styles')
<style type="text/css">
.admin-form-wrapper {
	max-width: 400px;
	margin:50px auto;
}

.admin-form-wrapper label {
	display:none;
}

.admin-form-wrapper div.checkbox {
	text-align: right;
}

.admin-form-wrapper .btn {
	width:100%;
}
</style>
@stop

@section('content')
<!--Reminder Box-->
<div id="adminFormWrapper" class="admin-form-wrapper">
	@if(Session::has('error'))
	<div class="alert alert-warning">
		<p><h4>오류</h4> {{Session::get('error')}}</p>
	</div>
	@elseif(Session::has('status'))
	<div class="alert alert-success">
		<p><h4>성공</h4> {{Session::get('status')}}</p>
	</div>
	@endif

	{{ Form::open(array('url'=>action('RemindersController@postRemind'), 'method'=>'post', 'role'=>'form')) }}
	<div class="form-group">
		<label for="userEmail">이메일</label>
		<input type="email" id="userEmail" name="email" class="form-control" placeholder="이메일" />
	</div>

	<div class="remind-controls form-group">
		<button type="submit" class="btn btn-primary">비밀번호 재설정 링크 보내기</button>
	</div>
	{{ Form::close() }}
</div>
<!--/Reminder Box-->
@stop

@section('footer_scripts')
@stop