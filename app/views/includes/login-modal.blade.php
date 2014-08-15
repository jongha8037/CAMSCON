<!--Login Modal-->
<div id="LoginModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h3>로그인</h3>
						<div class="login-with-fb-wrapper">
							<button type="button" class="login-with-fb-btn btn btn-primary">페이스북으로 로그인</button>
						</div>
						<div class="login-with-email-wrapper">
							{{ Form::open(array('url'=>action('UserController@loginWithEmail'))) }}
								<div class="form-group">
									<label for="loginEmail">이메일로 로그인</label>
									<input type="email" id="loginEmail" name="email" class="form-control" placeholder="이메일" />
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="비밀번호" />
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> 기억하기
									</label>
								</div>
								<div class="login-controls row">
									<div class="col-xs-6">
										<a href="" class="reset-pswd-btn btn btn-default">비밀번호 재설정</a>
									</div>
									<div class="col-xs-6">
										<button type="button" class="login-with-email-btn btn btn-primary">로그인</button>
									</div>
								</div>
							{{ Form::close() }}
						</div>
					</div><!--//left col-->
					<div class="col-xs-12 col-sm-6">
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
									<button type="button" class="signup-with-email-btn btn btn-primary">가입</button>
								</div>
							{{ Form::close() }}
						</div>
					</div><!--//right col-->
				</div><!--/.row-->
			</div><!--/.modal-body-->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/Login Modal-->

<script type="text/javascript">
var LoginModal={
	jqo:null,
	init:function() {
		this.jqo=$('#LoginModal');
		this.jqo.modal();
	}/*init()*/,
	launch:function() {
		this.jqo.modal('show');
	}/*launch()*/
};

$(document).ready(function() {
	LoginModal.init();
});
</script>