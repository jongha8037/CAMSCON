@extends('front.layouts.master')

@section('head_styles')
<style type="text/css">
.pswd-reset {
	width:100%;
	max-width:400px;
	margin:40px auto;
}

.pswd-reset .btn-primary {
	width:100%;
}
</style>
@stop

@section('content')
<div class="pswd-reset">
	@if(Session::has('error'))
	<div class="alert alert-danger">
		<p><strong>오류!</strong> {{Session::get('error')}}</p>
	</div>
	@endif

	{{ Form::open(array('url'=>action('RemindersController@postReset'), 'method'=>'POST')) }}
		<input type="hidden" name="token" value="{{ $token }}" />

		<!--Email-->
		<div class="form-group">
			<label for="resetEmail">가입할 때 입력한 이메일 주소</label>
			<input type="email" class="form-control" id="resetEmail" name="email" />
		</div>

		<!--password-->
		<div class="form-group">
			<label for="resetPswd">새로운 비밀번호</label>
			<input type="password" class="form-control" id="resetPswd" name="password" />
		</div>

		<!--password_confirmation-->
		<div class="form-group">
			<label for="resetPswdConfirm">비밀번호 확인</label>
			<input type="password" class="form-control" id="resetPswdConfirm" name="password_confirmation" />
		</div>

		<button type="submit" class="btn btn-primary">비밀번호 변경하기</button>
	{{ Form::close() }}
</div><!--/.pswd-reset-->
@stop