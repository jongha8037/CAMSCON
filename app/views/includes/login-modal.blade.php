<style type="text/css">
	#LoginModal .btn {
		display:block;
		width:100%;
		font-weight:700;
	}

	#LoginModal .alert.alert-warning {
		background-color: rgba(0,0,0,0.7);
		color: #f56545;
		font-weight: 700;
		border-color: rgba(0,0,0,0.7);
	}

	#LoginModal .alert.alert-info {
		background-color: rgba(0,0,0,0.7);
		color: #7ed4d3;
		font-weight: 700;
		border-color: rgba(0,0,0,0.7);
	}

	#LoginModal .login-error-msg-wrapper, 
	#LoginModal .signup-error-msg-wrapper,
	#LoginModal .login-info-msg-wrapper {
		display: none;
	}

	#LoginModal .login-logo {
		padding:23px 0px;
		text-align: center;
	}

	#LoginModal .login-text {
		margin: 4px 0px 24px 0px;
	}

	#LoginModal .login-text p {
		color:#fff;
		text-align:center;
		font-size:16px;
		margin-bottom:0px;
	}

	#LoginModal .login-text p:first-child {
		font-style: italic;
	}

	#LoginModal .modal-body {
		background-image: url("http://cdn.camscon.kr/front-assets/login-modal/login_bg.png");
		background-position: 50% 0%;
		background-repeat: no-repeat;
		background-color: #000;
		min-height:612px;
	}

	#LoginModal .modal-content {
		border: 0;
	}

	#LoginModal .inner-wrapper {
		width: 100%;
		max-width: 363px;
		margin: 0px auto;
	}

	#LoginModal .inner-wrapper > div {
		margin-bottom: 15px;
	}

	#LoginModal .login-with-fb-btn {
		background-color: #37538e;
		border-color: #37538e;
		padding: 12px 0px;
	}

	#LoginModal .login-with-fb-btn img {
		vertical-align: text-bottom;
	}

	#LoginModal .login-with-email-wrapper, 
	#LoginModal .signup-form-wrapper {
		background-color: rgba(255,255,255,0.35);
		padding: 10px 20px;
	}

	#LoginModal .signup-toggle {
		padding: 17px 0px;
	}

	#LoginModal .signup-form-wrapper {
		display: none;
	}

	#LoginModal label {
		color: #fff;
		font-weight: 700;
	}

	#LoginModal .form-group > label {
		font-weight: 400;
		font-size: 19px;
		line-height: 1;
		margin-bottom: 10px;
	}

	#LoginModal .gender-controls input[type="radio"] {
		display: none;
	}

	#LoginModal .gender-controls label{
		display: block;
		color: #fff;
		background-color: #bababa;
		font-weight: 400;
		padding: 9px 0px;
		text-align: center;
		cursor: pointer;
	}

	#LoginModal .gender-controls input[type="radio"]:checked+label{
		background-color: #56d8d1;
	}

	#LoginModal .alert {
		margin-bottom:0px;
	}
	
</style>

<!--Login Modal-->
<div id="LoginModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="login-logo"><img src="{{asset('front-assets/login-modal/login_camscon_logo.png')}}"></div>
				<div class="login-text">
					<p>Share your daily look, Share your fashion photography and Share your inspiration!</p>
					<p>CAMSCON을 통해 패션에 대한 영감을 공유하고 나누세요!</p>
				</div>
				<div class="inner-wrapper">
					<div class="login-error-msg-wrapper">
						<div class="alert alert-warning">
							<p class="login-error-msg"></p>
						</div>
					</div>

					<div class="login-info-msg-wrapper">
						<div class="alert alert-info">
							<p class="login-info-msg"></p>
						</div>
					</div>

					<div class="login-with-fb-wrapper">
						<button type="button" class="login-with-fb-btn btn btn-primary"><img src="{{asset('front-assets/login-modal/login_facebook.png')}}" />으로 계속하기</button>
					</div>

					<div class="login-with-email-wrapper">
						{{ Form::open(array('url'=>action('UserController@loginWithEmail'), 'class'=>'login-form')) }}
							<div class="form-group">
								<label for="loginEmail">Log In</label>
								<input type="email" id="loginEmail" name="email" class="form-control" placeholder="E-mail" />
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="비밀번호" />
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> 기억하기
								</label>
							</div>
							<button type="submit" class="login-with-email-btn btn btn-primary">Log in</button>
						{{ Form::close() }}
					</div>

					<div class="signup-btn-wrapper">
						<button type="button" class="signup-toggle btn btn-danger">이메일로 회원가입</button>
					</div>

					<div class="signup-error-msg-wrapper">
						<div class="alert alert-warning">
							<p class="signup-error-msg"></p>
						</div>
					</div>

					<div class="signup-form-wrapper">
						{{ Form::open(array('url'=>action('UserController@signupUser'), 'class'=>'singup-form')) }}
							<div class="form-group">
								<label for="singupEmail">Sign up</label>
								<input type="email" id="signupEmail" name="email" class="form-control" placeholder="E-mail" />
							</div>
							<div class="form-group">
								<input type="text" name="nickname" class="form-control" placeholder="닉네임" />
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="비밀번호" />
							</div>
							<div class="form-group">
								<input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인" />
							</div>
							<div class="gender-controls row">
								<div class="col-xs-6">
									<input type="radio" id="signupGenderFemale" name="gender" value="female" />
									<label for="signupGenderFemale">여자</label>
								</div>
								<div class="col-xs-6">
									<input type="radio" id="signupGenderMale" name="gender" value="male" />
									<label for="signupGenderMale">남자</label>
								</div>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> 기억하기
								</label>
							</div>
							<button type="submit" class="btn btn-primary">가입하기</button>
						{{ Form::close() }}
					</div>
				</div><!--/.inner-wrapper-->
			</div><!--/.modal-body-->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/Login Modal-->

<script type="text/javascript">
var LoginModal={
	login_status:@if(Auth::check()){{'true'}}@else{{'false'}}@endif,
	total_page_count:{{$tracker->total_page_count}},
	restricted_page_count:{{$tracker->restricted_page_count}},
	@if(Session::has('intended'))
	intended:"{{Session::get('intended')}}",
	@else
	intended:null,
	@endif
	jqo:null,
	endpoints:{
		fb:"{{action('UserController@loginWithFB')}}",
		email:"{{action('UserController@loginWithEmail')}}",
		signup:"{{action('UserController@signupUser')}}"
	},
	init:function() {
		//Set modal jquery object
		this.jqo=$('#LoginModal');
		
		//Attach submit event handler
		this.jqo.find('.login-form').submit(function(e) {
			e.preventDefault();
			LoginModal.hideLoginError();
			LoginModal.proc_login_email($(this));
		});

		//Attach submit event handler
		this.jqo.find('.singup-form').submit(function(e) {
			e.preventDefault();
			LoginModal.hideSignupError();
			LoginModal.proc_signup($(this));
		});

		//Attach signup form toggle handler
		this.jqo.find('.signup-toggle').click(function() {
			LoginModal.hideSignupError();
			LoginModal.hideLoginInfo();
			LoginModal.jqo.find('.signup-form-wrapper').toggle();
		});

		//Init modal
		this.jqo.modal({
			backdrop:'static',
			keyboard:false,
			show:false
		});

		//Login wall
		if(this.restricted_page_count>1 && this.login_status===false) {
			this.launch();
		}

		//Attach Login with FB btn handler
		this.jqo.find('.login-with-fb-btn').click(function() {
			LoginModal.hideLoginError();
			LoginModal.setLoginInfo('페이스북으로 로그인하는 중입니다...<br />처음 로그인하는 경우에는 다소 시간이 걸릴 수 있습니다.');
			//Start FB login
			FB.login(function(response) {
				if(response.authResponse) {
					//Start backend login.
					LoginModal.login_fb_backend();
				} else {
					LoginModal.setLoginError('페이스북 로그인이 취소됐습니다 :(');
					LoginModal.hideLoginInfo();
					LoginModal.enableBtns();
				}
			}, {scope:'email'});
			//LoginModal.proc_login_fb();
		});
	}/*init()*/,
	launch:function() {
		this.jqo.modal('show');
	}/*launch()*/,
	/*Removed due to popup blocking
	proc_login_fb:function() {
		LoginModal.disableBtns();
		FB.getLoginStatus(function(response) {
			if(response.status==='connected') {
				//Logged in. Start backend login.
				LoginModal.login_fb_backend();
			} else {
				//Start FB login
				FB.login(function(response) {
					if(response.authResponse) {
						//Start backend login.
						LoginModal.login_fb_backend();
					} else {
						LoginModal.setLoginError('페이스북 로그인이 취소됐습니다 :(');
					}
					LoginModal.hideLoginInfo();
					LoginModal.enableBtns();
				}, {scope:'email'});
			}
		});
	},
	*/
	login_fb_backend:function() {
		var data={
			_token:this.jqo.find('input[name="_token"]').val()
		};

		$.post(this.endpoints.fb, data, function(response) {
			if(typeof response === 'object' && 'type' in response) {
				LoginModal.hideLoginInfo();
				if(response.type=='success') {
					if(LoginModal.intended==null) {
						LoginModal.login_status=true;
						$('#UserBox').html(response.msg);
						LoginModal.jqo.modal('hide');
					} else {
						window.location.href=LoginModal.intended;
					}
				} else if(response.type=='error') {
					switch(response.msg) {
						case 'fb_api_error':
							LoginModal.setLoginError('페이스북 API에 접근할 수 없습니다! :(');
						break;
						case 'fb_validation_error':
							LoginModal.setLoginError('페이스북 로그인 실패! :(');
						break;
						case 'db_error':
							LoginModal.setLoginError('데이터베이스 오류가 발생했습니다! :(');
						break;
						case 'fb_profile_error':
							LoginModal.setLoginError('페이스북 프로필에 접근할 수 없습니다! :(');
						break;
						default:
							LoginModal.setLoginError('알 수 없는 오류가 발생했습니다 :(');
					}
					LoginModal.enableBtns();
				} else {
					LoginModal.setLoginError('알 수 없는 오류가 발생했습니다 :(');
					LoginModal.enableBtns();
				}
			}
		}, 'json');
	}/*login_fb_backend()*/,
	proc_login_email:function(loginForm) {
		LoginModal.disableBtns();
		var data=loginForm.serialize();
		$.post(this.endpoints.email, data, function(response) {
			LoginModal.enableBtns();
			if(typeof response === 'object' && 'type' in response) {
				if(response.type=='success') {
					if(LoginModal.intended==null) {
						LoginModal.login_status=true;
						$('#UserBox').html(response.msg);
						LoginModal.jqo.modal('hide');
					} else {
						window.location.href=LoginModal.intended;
					}
				} else {
					LoginModal.setLoginError('이메일 또는 비밀번호가 일치하지 않습니다! :(');
				}
			} else {
				LoginModal.setLoginError('서버로부터 적절한 응답을 받지 못했습니다! :(');
			}
		}, 'json');
	}/*proc_login_email()*/,
	setLoginError:function(msg) {
		this.jqo.find('.login-error-msg').html(msg);
		this.jqo.find('.login-error-msg-wrapper').show();
	}/*setLoginError()*/,
	hideLoginError:function() {
		this.jqo.find('.login-error-msg-wrapper').hide();
	}/*hideLoginError()*/,
	proc_signup:function(signupForm) {
		var data=signupForm.serialize();
		$.post(this.endpoints.signup, data, function(response) {
			LoginModal.enableBtns();
			if(typeof response === 'object' && 'type' in response) {
				if(response.type=='success') {
					if(LoginModal.intended==null) {
						LoginModal.login_status=true;
						$('#UserBox').html(response.msg);
						LoginModal.jqo.modal('hide');
					} else {
						window.location.href=LoginModal.intended;
					}
				} else {
					var msg=null;
					switch(response.msg) {
						case 'email_required':
							msg='이메일이 입력되지 않았습니다! :(';
							break;
						case 'email_email':
							msg='이메일 형식이 잘못됐습니다! :(';
							break;
						case 'email_unique':
							msg='이미 가입된 이메일 입니다! :(';
							break;
						case 'nickname_required':
							msg='닉네임이 입력되지 않았습니다! :(';
							break;
						case 'nickname_min':
							msg='닉네임은 3글자 이상이어야 합니다! :(';
							break;
						case 'nickname_unique':
							msg='사용할 수 없는 닉네임 입니다! :(';
							break;
						case 'password_required':
							msg='비밀번호가 입력되지 않았습니다! :(';
							break;
						case 'password_min':
							msg='비밀번호는 8자리 이상이어야 합니다! :(';
							break;
						case 'password_confirmed':
							msg='비밀번호 확인값이 일치하지 않습니다! :(';
							break;
						case 'gender_required':
							msg='성별이 선택되지 않았습니다! :(';
							break;
						case 'gender_in':
							msg='성별 선택값이 잘못됐습니다! :(';
							break;
						default:
							msg='알 수 없는 오류가 발생했습니다 :(';
					}
					LoginModal.setSignupError(msg);
				}
			} else {
				LoginModal.setLoginError('서버로부터 적절한 응답을 받지 못했습니다! :(');
			}
		}, 'json');
	}/*proc_signup()*/,
	setSignupError:function(msg) {
		this.jqo.find('.signup-error-msg').html(msg);
		this.jqo.find('.signup-error-msg-wrapper').show();
	}/*setSignupError()*/,
	hideSignupError:function() {
		this.jqo.find('.signup-error-msg-wrapper').hide();
	}/*hideSignupError()*/,
	setLoginInfo:function(msg) {
		this.jqo.find('.login-info-msg').html(msg);
		this.jqo.find('.login-info-msg-wrapper').show();
	}/*setLoginInfo()*/,
	hideLoginInfo:function() {
		this.jqo.find('.login-info-msg-wrapper').hide();
	}/*hideLoginInfo()*/,
	disableBtns:function() {
		this.jqo.find('button').prop('disabled', true);
	}/*disableBtns()*/,
	enableBtns:function() {
		this.jqo.find('button').prop('disabled', false);
	}/*enableBtns()*/
};

$(document).ready(function() {
	LoginModal.init();
});
</script>