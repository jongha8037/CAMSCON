<div class="reset-form-wrapper">
	@if(Session::has('error'))
	<div class="alert alert-warning">
		<h4>오류</h4>
		<p>{{Session::get('error')}}</p>
	</div>
	@endif

	{{ Form::open(array('url'=>action('RemindersController@postReset'), 'method'=>'post')) }}
		<input type="hidden" name="token" value="{{ $token }}">
		<input type="email" name="email">
		<input type="password" name="password">
		<input type="password" name="password_confirmation">
		<button type="submit">비밀번호 변경하기</button>
	{{ Form::close() }}
</div>