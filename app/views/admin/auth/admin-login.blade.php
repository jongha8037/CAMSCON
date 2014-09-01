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
			<a href="{{action('RemindersController@getAdminRemind')}}" class="btn btn-default">비밀번호 재설정</a>
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
var User={
	endpoints:{
		loginWithFB:"{{$fbLoginURL}}"
	},
	csrf_token:"{{csrf_token()}}",
	status:@if(Auth::check()){{'true'}}@else{{'false'}}@endif,
	intended:"{{url($intended)}}",
	loginWithFB:function() {
		$('#loginFormMsg').text('연결된 페이스북 계정으로 로그인을 시도하고 있습니다...');

		//Ajax login
		var data={
			_token:this.csrf_token
		}

		$.post(this.endpoints.loginWithFB,data,function(response) {
			$('#loginFormMsg').text('');
			
			//Basic response validation
			if('type' in response && (response.type=='success' || response.type=='error')) {
				//Pass response to loginResponseHandler()
				User.loginResponseHandler(response);
			}
		},'json');
	}/*loginWithFB()*/,
	loginResponseHandler:function(response) {
		if(response.type=='success') {
			//Handle intended redirection
			document.location.href=this.intended;
		} else if(response.type=='error') {
			//Set alert message
			var alertMsg='알 수 없는 에러가 발생했습니다.';
			switch(response.msg) {
				case 'fb_api_error':
					alertMsg='페이스북 API 장애가 발생했습니다. 잠시 후에 다시 시도해 주세요 :(';
					break;
				case 'fb_validation_error':
					alertMsg='페이스북 로그인 오류가 발생했습니다. 페이스북 로그인을 다시 시도해 주세요 :(';
					break;
				case 'no_user':
					alertMsg='존재하지 않는 사용자 입니다. 우선 가입을 하신 뒤에 관리자에게 권한을 요청하시기 바랍니다 :(';
					break;
			}
			//Launch alert modal
			AdminMaster.alertModal.launch(alertMsg,null,null);
		}
	}/*loginResponseHandler()*/,
	FB:{
		statusChangeCallback:function(response) {
			console.log(response);
			if(response.status==='connected' && User.status===false) {
				//Login to app
				User.loginWithFB();
			} else if(response.status==='connected' && User.status===true) {
				//Handle intended redirection
				document.location.href=User.intended;
			}
		}/*statusChangeCallback()*/,
		checkLoginState:function() {
			FB.getLoginStatus(function(response) {
				if(response.status==='connected') {
					User.FB.statusChangeCallback(response);
				} else {
					//Login to facebook
					User.FB.loginToFacebook();
				}
			});
		}/*checkLoginState()*/,
		loginToFacebook:function() {
			FB.login(function(response) {
				if(response.authResponse) {
					User.FB.statusChangeCallback(response);
				} else {
					//Handle cacellation by user
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope:'public_profile,email'});
		}/*loginToFacebook()*/
	}/*FB*/
};

$(document).ready(function() {
	$(document).on('click','#fbLoginBtn',null,function() {
		User.FB.checkLoginState();
	});
});
</script>
@stop