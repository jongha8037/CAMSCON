@extends('front.layouts.master')

@section('head_title')
Sign up
@stop

@section('head_styles')
<style type="text/css">
.login-required {
	margin:40px auto;
	width:100%;
	max-width: 300px;
}

.login-required h3 {
	margin-top:0px;
}

.login-required h3 span {
	vertical-align: bottom;
}

.login-required button {
	width:100%;
}
</style>
@stop

@section('content')
<div class="login-required">
	<div class="alert alert-info">
		<h3><span class="glyphicon glyphicon-exclamation-sign"></span> 권한 없음</h3>
		<p>로그인을 해야 접근이 가능한 페이지 입니다!</p>
	</div>

	@if(!Auth::check())
	<button class="btn btn-primary">로그인</button>
	@endif
</div>
@stop

@section('footer_scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('.login-required').on('click', 'button', {action:LoginModal.launch.bind(LoginModal)}, function(e) {
		e.data.action();
	});
});
</script>
@stop