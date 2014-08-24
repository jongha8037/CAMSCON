@extends('front.layouts.master')

@section('head_title')
Sign up
@stop

@section('head_styles')
<style type="text/css">
.login-with-fb-wrapper, 
.signup-with-fb-wrapper {
	padding-bottom: 10px;
	border-bottom: 1px solid #ddd;
	margin-bottom: 10px;
}

#LoginModal .btn {
	display:block;
	width:100%;
}
</style>
@stop

@section('content')
<h3>가입하기</h3>
<div class="signup-with-fb-wrapper">
	<button type="button" class="signup-with-fb-btn btn btn-primary">페이스북으로 가입</button>
</div>
<div class="signup-with-email-wrapper">
	{{ Form::open(array('url'=>action('UserController@signupUser'))) }}
		<input type="hidden" name="signup_type" value="email" />
		<div class="form-group">
			<label for="loginEmail">이메일로 가입</label>
			<input type="email" name="email" class="form-control" placeholder="이메일" />
		</div>
		<div class="form-group pswd-fields">
			<input type="password" name="password" class="form-control" placeholder="비밀번호" />
		</div>
		<div class="form-group pswd-fields">
			<input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인" />
		</div>
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="이름" />
		</div>
		<div class="form-group">
			<input type="text" name="nickname" class="form-control" placeholder="닉네임" />
		</div>
		<div class="radio">
			<label class="radio-inline">
				<input type="radio" id="signupGenderMale" name="gender" value="male"> 남자
			</label>
			<label class="radio-inline">
				<input type="radio" id="signupGenderFemale" name="gender" value="female"> 여자
			</label>
		</div>
		<div class="signup-controls">
			<button type="submit" class="signup-with-email-btn btn btn-primary">가입</button>
		</div>
	{{ Form::close() }}
</div>
@stop

@section('footer_scripts')
<script type="text/javascript"></script>
@stop