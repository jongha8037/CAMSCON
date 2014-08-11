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

.admin-form-wrapper div.checkbox {
	text-align: right;
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
	@if(Session::has('login_error'))
	<div class="alert alert-warning">
		<p><h4>로그인 오류</h4> 이메일 또는 비밀번호가 일치하지 않습니다! :(</p>
	</div>
	@endif

	{{ Form::open(array('url'=>action('AdminController@loginWithEmail'), 'method'=>'post', 'role'=>'form')) }}
	<div class="form-group">
		<label for="userEmail">이메일</label>
		<input type="email" id="userEmail" name="email" class="form-control" placeholder="이메일" />
	</div>

	<div class="form-group">
		<label for="userPswd">비밀번호</label>
		<input type="password" id="userPswd" name="password" class="form-control" placeholder="비밀번호" />
	</div>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="remember"> 기억하기
		</label>
	</div>

	<div class="login-controls row">
		<div class="col-xs-12 col-sm-4">
			<button type="button" id="fbLoginBtn" class="btn btn-primary">Login with FB</button>
		</div>
		<div class="col-xs-12 col-sm-4">
			<button type="button" class="btn btn-default">비밀번호 재설정</button>
		</div>
		<div class="col-xs-12 col-sm-4">
			<button type="submit" class="btn btn-primary">로그인</button>
		</div>

		<div class="col-xs-12">
			<p id="loginFormMsg" class="text-info"></p>
		</div>
	</div>
	{{ Form::close() }}
</div>
<!--/Login Box-->
@stop

@section('footer_scripts')
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click','#fbLoginBtn',null,function() {
		User.FB.checkLoginState();
	});
});
</script>
@stop