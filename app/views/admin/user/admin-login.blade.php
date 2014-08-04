@extends('admin.layouts.admin-master')

@section('head_title')
Admin Login
@stop

@section('head_styles')
<style type="text/css">
.admin-form-wrapper {
	max-width: 400px;
	margin:50px auto;
}

.admin-form-wrapper .btn {
	width:100%;
}

.login-controls div {
	padding:5px;
}

.login-controls div:first-child {
	padding-left:0px;
}

.login-controls div:last-child {
	padding-right:0px;
}

.login-controls {
	padding:0px 15px;
}
</style>
@stop

@section('content')
<!--Login Box-->
<div id="adminFormWrapper" class="admin-form-wrapper">
	<div class="msgs-wrapper"></div>
	{{ Form::open(array('url'=>action('AdminController@loginUser'), 'method'=>'post', 'role'=>'form')) }}
	<div class="form-group">
		<label for="userEmail">이메일</label>
		<input type="email" id="userEmail" name="email" class="form-control" placeholder="이메일" />
	</div>
	<div class="form-group">
		<label for="userPswd">비밀번호</label>
		<input type="password" id="userPswd" name="password" class="form-control" placeholder="비밀번호" />
	</div>
	<div class="login-controls row">
		<div class="col-xs-12 col-sm-4">
			<button class="btn btn-primary">Login with FB</button>
		</div>
		<div class="col-xs-12 col-sm-4">
			<button class="btn btn-default">비밀번호 되찾기</button>
		</div>
		<div class="col-xs-12 col-sm-4">
			<button class="btn btn-primary">로그인</button>
		</div>
	</div>
	{{ Form::close() }}
</div>
<!--/Login Box-->
@stop

@section('footer_scripts')
@stop