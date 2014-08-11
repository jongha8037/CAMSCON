{{ Form::open(array('url'=>'')) }}
	<div id="fbProfileBox" class=""></div>
	<input type="radio" name="type" value="camscon" />
	<input type="radio" name="type" value="fb" />
	<input type="email" name="email" placeholder="" value="" />
	<div class="signup-password-fields">
		<input type="password" name="password" placeholder="" value="" />
		<input type="password" name="password_confirmation" placeholder="" value="" />
	</div>
	<input type="text" name="nickname" placeholder="" value="" />
	<button type="submit">가입하기</button>
{{ Form::close() }}