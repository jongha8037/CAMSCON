@extends('front.layouts.master')

@section('head_title')
비밀번호 재설정 메일 보내기
@stop

@section('head_styles')
<style type="text/css">
.pswd-recovery {
	width:100%;
	max-width:400px;
	margin:40px auto;
}

.pswd-recovery .btn-primary {
	width:100%;
}
</style>
@stop

@section('content')
<div class="pswd-recovery">
	@if(Session::has('error'))
	<div class="alert alert-danger">
		<p><strong>오류!</strong> {{Session::get('error')}}</p>
	</div>
	@elseif(Session::has('status'))
	<div class="alert alert-success">
		<p><strong>성공!</strong> {{Session::get('status')}}</p>
	</div>
	@else
	<div class="alert alert-info">
		<p><strong>알림!</strong> 페이스북 계정으로 가입하신 경우에는 이 페이지에서 비밀번호 재설정을 하는 것이 불가능 합니다.</p>
	</div>
	@endif

	{{ Form::open(array('url'=>action('RemindersController@postRemind'), 'method'=>'POST')) }}
		<div class="form-group">
			<label for="recoveryEmail">가입할 때 입력한 이메일 주소</label>
			<input type="email" class="form-control" id="recoveryEmail" name="email" placeholder="">
		</div>

		<button type="submit" class="btn btn-primary">비밀번호 재설정 링크 보내기</button>
	{{ Form::close() }}
</div><!--/.pswd-recovery-->
@stop