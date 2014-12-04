@extends('front.layouts.master')

@section('head_title')
Inspirer Signup - CAMSCON
@stop

@section('head_styles')
<!--FB Open Graph tags-->
<meta property="og:title" content="Inspirer Register - CAMSCON" />
<meta property="og:site_name" content="CAMSCON" />
<meta property="og:url" content="{{action('InspirerRegisterController@showRegister')}}" />
<meta property="og:description" content="캠스콘과 컨텐츠 제휴를 신청합니다." />
<meta property="og:image" content="http://cdn.camscon.kr/front-assets/layouts/fb_og.jpg" />
<meta property="fb:app_id" content="562009567255774" />
<meta property="og:locale" content="ko_KR" />

<style type="text/css">
.unsupported-media {
	max-width:420px;
	margin:20px auto;
}

.inspirer-register {
	display: none;
}

@media (min-width: 992px) {
	.unsupported-media {
		display: none;
	}

	.inspirer-register {
		display: block;
		min-height: 777px;
		margin:25px 0px;
		padding:60px 15px;
		color:#3e3e3e;

		background-image:url("{{asset('/front-assets/inspirer-register/bg-img.jpg')}}");
		background-repeat: no-repeat;
		background-position: 0px 0px;
		background-size: 100% auto;
	}

	.instructions-wrapper {
		float:left;
		width:460px;
	}

	.instructions-wrapper .instructions {
		background-color:rgba(255,255,255,0.65);
	}

	.instructions-wrapper .instructions {
		padding: 60px 15px;
	}

	.instructions-wrapper .instructions h1 {
		font-weight: 700;
		text-align: center;
		font-size: 22px;
		margin:0px 0px 60px 0px;
	}

	.instructions-wrapper h4.footer {
		color:#fff;
		text-align: right;
		font-size: 16px;
		font-weight: 700;
	}

	.form-wrapper {
		float:right;
		width:460px;
		background-color:rgba(255,255,255,0.65);
		padding: 35px 15px 44px 25px;
	}

	.form-wrapper .alert {
		background-color: rgba(0,0,0,0.7);
		border: none;
	}

	.form-wrapper .alert-danger {
		color: #f56545;
	}

	.form-wrapper .alert-success {
		color: #BBF75E;
	}

	.register-form .left-col, 
	.register-form .right-col {
		width:50%;
		float:left;
	}

	.register-form .left-col {
		padding-top: 10px;
		padding-right:30px;
	}

	.register-form .right-col-outline {
		padding:10px;
		border: 1px solid #f56545;
	}

	.register-form .right-col-instructions {
		color:#f56545;
		font-size:10px;
		text-align: right;
	}

	.register-form .form-footer {
		clear:both;
		padding-top:30px;
	}

	.register-form .field-item {
		margin-bottom:15px;
		border-color: #3e3e3e;
	}

	.register-form .field-item.has-error {
		color: #f56545;
		border-color: #f56545;
	}

	.register-form input:focus {
		outline: 0;
	}

	.register-form input {
		width:100%;
		background:0;
		border:0;
		border-bottom:1px solid #3e3e3e;
		border-color: inherit;
	}

	.register-form label {
		margin-bottom:0px;
	}

	.register-form label.required:after {
		content:' *';
		color:#f56545;
	}

	.register-form .label-description {
		color: #777;
		font-size: 13px;
		margin-bottom: 5px;
	}

	.register-form .register-submit {
		width: 100%;
		font-size: 17px;
		font-weight: 700;
		padding: 8px 0px;

	}
}

@media (min-width: 1200px) {
	.inspirer-register {
		padding:60px 49px;
	}

	.instructions-wrapper {
		width:496px;
	}

	.instructions-wrapper .instructions h1 {
		margin:0px 0px 75px 0px;
	}

	.instructions-wrapper .instructions h1 br {
		display: none;
	}

	.form-wrapper {
		width:556px;
	}
}
</style>
@stop

@section('content')
<div class="inspirer-register clearfix">
	<div class="instructions-wrapper">
		<div class="instructions clearfix">
			<h1>Register as a <br /> CAMSCON FASHION INSPIRER!</h1>
			<p><strong>캠스콘</strong>은 거리와 캠퍼스의 패션 사진가들, 픽토리얼 사진가, 패션블로거들이 자신이 촬영한 <span>패션사진과 데일리룩을 공유하는 소셜미디어</span>입니다.</p>
			<p><strong>Inspirer</strong>이란, '영감을 주다'라는 의미의 'inspire'에서 유래된 단어로, 사전에 캠스콘에 신청을 하여 등록승인이 된 사진가들이나 패션블로거를 의미합니다. 이들은, 자신의 감각을 통해 대중들에게 패션에 대한 영감을 주고 있으며, 캠스콘 패션사진을 공유하고 있습니다. </p>
			<p>보다 많은 사람들과 촬영한 패션사진을 통해 당신의 감각과 안목을 공유하고 싶다면, Inspirer로 신청하세요. 오른쪽의 신청양식을 제출해주시면 연락 드리겠습니다 :)</p>
			<p><strong>Share your inspiration!</strong><br />
			당신의 영감에 보다 많은 사람들이 공감하기를 캠스콘은 원합니다.</p>
		</div>
		<h4 class="footer">CAMSCON의 Inspirer로 등록하세요 :)</h4>
	</div>
	<div class="form-wrapper">

		@if(Session::has('proc_result'))
			@if(Session::get('proc_result')=='db_error')
			<div class="alert alert-danger"><strong>실패!</strong> 서버 오류가 발생했습니다 :( 잠시 후에 다시 시도해 주세요.</div>
			@elseif(Session::get('proc_result')=='success')
			<div class="alert alert-success"><strong>성공!</strong> 안내 글</div>
			@endif
		@elseif(count($errors)>0)
		<div class="alert alert-danger"><strong>실패!</strong> 입력값이 잘못된 항목이 있습니다 :(</div>
		@endif

		<!--Temporary-->
		<div class="alert alert-danger"><strong>실패!</strong> 데이터베이스 오류가 발생했습니다 :( 잠시 후에 다시 시도해 주세요.</div>
		<div class="alert alert-success"><strong>성공!</strong> 안내 글</div>
		<div class="alert alert-danger"><strong>실패!</strong> 입력값이 잘못된 항목이 있습니다 :(</div>
		<!--//Temporary-->

		{{ Form::open(array('url'=>action('InspirerRegisterController@postRegister'), 'id'=>'inspirerRegisterForm', 'class'=>'register-form', 'role'=>'form')) }}
			<div class="left-col">
				<!--Name-->
				@if($errors->has('name'))
				<div class="field-item has-error">
				@else
				<div class="field-item">
				@endif
					<label for="inspirerName" class="required">이름</label>
					<input type="text" id="inspirerName" name="name" @if(Input::old('name'))value="{{Input::old('name')}}"@endif />
				</div>

				<!--Nickname-->
				@if($errors->has('nickname'))
				<div class="field-item has-error">
				@else
				<div class="field-item">
				@endif
					<label for="inspirerNickname" class="required">닉네임</label>
					<input type="text" id="inspirerNickname" name="nickname" @if(Input::old('nickname'))value="{{Input::old('nickname')}}"@endif />
				</div>

				<!--Mobile-->
				@if($errors->has('mobile'))
				<div class="field-item has-error">
				@else
				<div class="field-item">
				@endif
					<label for="inspirerMobile" class="required">휴대전화</label>
					<input type="text" id="inspirerMobile" name="mobile" @if(Input::old('mobile'))value="{{Input::old('mobile')}}"@endif />
				</div>

				<!--Email-->
				@if($errors->has('email'))
				<div class="field-item has-error">
				@else
				<div class="field-item">
				@endif
					<label for="inspirerEmail" class="required">E-mail</label>
					<input type="text" id="inspirerEmail" name="email" @if(Input::old('email'))value="{{Input::old('email')}}"@endif />
				</div>
			</div><!--/.left-col-->

			<div class="right-col">
				<div class="right-col-outline">
					<!--Website-->
					@if($errors->has('website'))
					<div class="field-item has-error">
					@else
					<div class="field-item">
					@endif
						<label for="inspirerWebsite">개인 웹사이트주소</label>
						<input type="text" id="inspirerWebsite" name="website" @if(Input::old('website'))value="{{Input::old('website')}}"@endif />
					</div>

					<!--Blog-->
					@if($errors->has('blog'))
					<div class="field-item has-error">
					@else
					<div class="field-item">
					@endif
						<label for="inspirerBlog">블로그 주소</label>
						<input type="text" id="inspirerBlog" name="blog" @if(Input::old('blog'))value="{{Input::old('blog')}}"@endif />
					</div>

					<!--Facebook-->
					@if($errors->has('facebook'))
					<div class="field-item has-error">
					@else
					<div class="field-item">
					@endif
						<label for="inspirerFacebook">페이스북 프로필주소</label>
						<input type="text" id="inspirerFacebook" name="facebook" @if(Input::old('facebook'))value="{{Input::old('facebook')}}"@endif />
					</div>

					<!--Instagram-->
					<div class="field-item">
						<label for="inspirerInstagram">인스타그램 계정</label>
						<input type="text" id="inspirerInstagram" name="instagram" @if(Input::old('instagram'))value="{{Input::old('instagram')}}"@endif />
					</div>
				</div><!--/.right-col-outline-->
				<p class="right-col-instructions">▲ 다음항목들은 현재 운영하고 있는 것만 입력해주세요</p>
			</div><!--/.right-col-->

			<div class="form-footer">
				<!--CAMSCON account nickname or email-->
				@if($errors->has('camscon'))
				<div class="field-item has-error">
				@else
				<div class="field-item">
				@endif
					<label for="inspirerCamscon" class="required">캠스콘 온라인닉네임 혹은 이메일</label>
					<p class="label-description">(가입 후 My Page에서 입력한 것을 기입해주세요)</p>
					<input type="text" id="inspirerCamscon" name="camscon" @if(Input::old('camscon'))value="{{Input::old('camscon')}}"@endif />
				</div>

				<button type="submit" class="register-submit btn btn-primary">제출하기</button>
			</div><!--/.form-footer-->
		{{ Form::close() }}
	</div>
</div><!--/.inspirer-register-->

<div class="unsupported-media">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">지원되지 않는 기기</h3>
		</div>
		<div class="panel-body">
			Inspirer Register 신청서는 데스크탑에서만 작성하실 수 있습니다.
		</div>
	</div>
</div><!--/.unsupported-media-->
@stop

@section('footer_scripts')
<script type="text/javascript" src="{{asset('packages/jquery-ui-custom/jquery-ui-core-widget.1.11.2.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('packages/jquery-autoresize/jquery.autoresize.js')}}"></script> -->
<script type="text/javascript" src="{{asset('packages/handlebars/handlebars-v2.0.0.js')}}"></script>
<!-- <link rel="stylesheet" type="text/css" href="{{asset('packages/jquery-autoresize/autoresize.css')}}" /> -->

<script type="text/javascript">
(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		$('#inspirerRegisterForm').on('submit', null, {handler:module.submitHandler.bind(module)}, function(e) {
			e.data.handler($(this));
		});
	});
})(window, document, jQuery, {
	/*Inspirer Register Module*/
	validationPatterns:{
		protocol:/^(http:\/\/|https:\/\/)/i
	},
	submitHandler:function(form) {
		var website=form.find('#inspirerWebsite');
		website.val( this._urlFilter(website.val()) );

		var blog=form.find('#inspirerBlog');
		blog.val( this._urlFilter(blog.val()) );

		var facebook=form.find('#inspirerFacebook');
		facebook.val( this._urlFilter(facebook.val()) );
	},
	_urlFilter:function(rawUrl) {
		var filterResult=null;
		if(rawUrl.length>0) {
			if( this.validationPatterns.protocol.test(rawUrl)!==true ) {
				filterResult='http://'+rawUrl;
			} else {
				filterResult=rawUrl;
			}
		}
		return filterResult;
	}
});
</script>
@stop