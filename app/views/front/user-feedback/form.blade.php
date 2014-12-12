@extends('front.layouts.master')

@section('head_title')
Feedback form - CAMSCON
@stop

@section('head_styles')
<!--FB Open Graph tags-->
<meta property="og:title" content="Feedback form - CAMSCON" />
<meta property="og:site_name" content="CAMSCON" />
<meta property="og:url" content="{{action('UserFeedbackController@showForm')}}" />
<meta property="og:description" content="조금이라도 불편하시거나, 오류가 발생할 때, CAMSCON에 건의하거나 제안해주고 싶은 사항이 있으시다면 아래에 내용을 입력해 제출해주세요 :) 바로 반영하여 수정하거나 리뉴얼 시, 꼭 반영하도록 하겠습니다." />
<meta property="og:image" content="http://cdn.camscon.kr/front-assets/layouts/fb_og.jpg" />
<meta property="fb:app_id" content="562009567255774" />
<meta property="og:locale" content="ko_KR" />

<style type="text/css">

.feedback-wrapper {
	background-image: url(http://camscon.dev/front-assets/user-feedback/bg-img.jpg);
	max-height:1152px;
	background-repeat: no-repeat;
	background-position: 50% 50%;
	margin:0px -15px;
}

/*Feedback Form*/
.feedback-wrapper .form-wrapper {
	max-width:297px;
	margin:25px auto;
	background-color:rgba(255,255,255,0.75);
}

.feedback-wrapper .failure-message {
	font-size:9px;
	color:#fff;
	background-color:#f56445;
	padding:4px 8px;
}

.feedback-wrapper .form {
	padding:33px 14px 25px 14px;
}

.feedback-wrapper h1 {
	font-size:15px;
	font-weight:700;
	text-align: center;
	margin:0px 0px 25px 0px;
}

.feedback-wrapper h1 strong {
	color:#f26645;
	text-decoration: underline;
}

.feedback-wrapper textarea {
	background-color: rgba(0,0,0,0);
	width:100%;
	max-width: 100%;
	min-height:127px;
	max-height:812px;
}

.feedback-wrapper .submit-bar {
	margin-top:7px;
	margin-bottom:19px;
	text-align: center;
}

.feedback-wrapper button {
	font-weight: 700;
}

.feedback-wrapper .form-wrapper p {
	margin-bottom:0px;
	text-align: center;
	font-size:13px;
}

/*Success Message*/
.feedback-wrapper .success-wrapper {
	max-width:307px;
	margin:119px auto;
	border-top:5px solid #66c4b4;
	background-color:rgba(255,255,255,0.75);
}

.feedback-wrapper .success-wrapper .success-message {
	border:1px solid #eaeaec;
	border-top:0;
	padding:26px 7px 8px 7px;
	text-align: center;
}

.feedback-wrapper .success-wrapper .success-message p {
	font-size:12px;
	margin-bottom:14px;
}

.feedback-wrapper .success-wrapper .success-message a {
	font-size: 11px;
	padding: 1px 9px;
	font-weight:700;
}

@media (min-width:768px) {
	.feedback-wrapper {
		margin:0px;
	}

	/*Feedback Form*/
	.feedback-wrapper .form-wrapper {
		max-width:621px;
		margin:122px auto;
	}

	.feedback-wrapper .failure-message {
		font-size:13px;
		padding:6px 0px;
		text-align: center;
	}

	.feedback-wrapper .form {
		padding:60px 62px 50px 62px;
	}

	.feedback-wrapper h1 {
		font-size:21px;
		margin-bottom:36px;
	}

	.feedback-wrapper textarea {
		min-height:240px;
		max-height:492px;
	}

	.feedback-wrapper .submit-bar {
		margin-top:15px;
		margin-bottom:40px;
	}

	.feedback-wrapper .form-wrapper p {
		font-size:14px;
		max-width:295px;
		margin:0px auto;
	}

	/*Success Message*/
	.feedback-wrapper .success-wrapper {
		max-width:587px;
		margin:298px auto;
		border-top:8px solid #66c4b4;
	}

	.feedback-wrapper .success-wrapper .success-message {
		padding:47px 92px 17px 92px;
	}

	.feedback-wrapper .success-wrapper .success-message p {
		font-size:18px;
		margin-bottom:18px;
	}

	.feedback-wrapper .success-wrapper .success-message a {
		font-size: 13px;
		padding: 1px 13px;
	}
}

@media (min-width:992px) {
	/*Feedback Form*/
	.feedback-wrapper .form-wrapper {
		max-width: 726px;
		margin:165px auto;
	}

	.feedback-wrapper .failure-message {
		font-size:14px;
		padding:7px 0px;
	}

	.feedback-wrapper .form {
		padding:52px 28px 34px 28px;
	}

	.feedback-wrapper h1 {
		font-size:24px;
		margin-bottom:45px;
	}

	.feedback-wrapper h1 br {
		display: none;
	}

	.feedback-wrapper textarea {
		min-height:289px;
		max-height:650px;
	}

	.feedback-wrapper .submit-bar {
		margin-bottom:0px;
	}

	.feedback-wrapper .submit-bar button {
		float:right;
	}

	.feedback-wrapper .form-wrapper p {
		max-width:425px;
		margin-top:27px;
	}

	/*Success Message*/
	.feedback-wrapper .success-wrapper {
		max-width:717px;
		margin:313px auto;
	}

	.feedback-wrapper .success-wrapper .success-message {
		padding:58px 122px 17px 122px;
	}

	.feedback-wrapper .success-wrapper .success-message p {
		font-size:21px;
		margin-bottom:19px;
	}

	.feedback-wrapper .success-wrapper .success-message a {
		font-size: 15px;
		padding: 1px 19px;
	}
}

@media (min-width:1200px) {
	/*Feedback Form*/
	.feedback-wrapper .form-wrapper {
		max-width: 691px;
		margin:187px auto;
	}

	.feedback-wrapper .form {
		padding:48px 30px 31px 30px;
	}

	.feedback-wrapper .failure-message {
		padding:8px 0px;
	}

	.feedback-wrapper h1 {
		font-size:23px;
		margin-bottom:43px;
	}

	.feedback-wrapper textarea {
		min-height:275px;
		max-height:459px;
	}

	.feedback-wrapper .form-wrapper p {
		max-width:400px;
	}

	/*Success Message*/
	.feedback-wrapper .success-wrapper {
		max-width:748px;
		margin:340px auto;
	}

	.feedback-wrapper .success-wrapper .success-message {
		padding:58px 127px 23px 127px;
	}

	.feedback-wrapper .success-wrapper .success-message p {
		margin-bottom:16px;
	}

	.feedback-wrapper .success-wrapper .success-message a {
		font-size: 13px;
		padding: 1px 14px;
	}
}
</style>
@stop

@section('content')
<div class="feedback-wrapper clearfix">
	@if(Session::get('proc_result')==='success')
	<div class="success-wrapper">
		<div class="success-message">
			<p>소중한 의견이 접수되었습니다 :) <br /> 다시 한 번, 감사드립니다. 지적해주신 부분은 꼭꼭 개선할게요!</p>
			<a href="{{url('/')}}" class="btn btn-primary">확인</a>
		</div>
	</div>
	@else
	<div class="form-wrapper">
		@if(Session::get('proc_result')==='db_error')
		<div class="failure-message"><strong>실패!</strong> DB 에러가 발생했습니다. 잠시 후에 다시 시도해주세요.</div>
		@elseif(Session::get('proc_result')==='empty_input')
		<div class="failure-message"><strong>실패!</strong> 빈 양식은 제출할 수 없습니다.</div>
		@endif
		{{ Form::open(array( 'url'=>action('UserFeedbackController@postFeedback'), 'class'=>'form' )) }}
			<h1>CAMSCON을 이용하시는 데에 <br /> <strong>불편하신 점</strong>을 모두 말씀해주세요</h1>
			<textarea name="feedback" class="form-control"></textarea>
			<div class="submit-bar">
				<button type="submit" class="btn btn-primary">제출하기</button>
			</div>
			<p>조금이라도 불편하시거나, 오류가 발생할 때, CAMSCON에 건의하거나 제안해주고 싶은 사항이 있으시다면 아래에 내용을 입력해 제출해주세요 :) 바로 반영하여 수정하거나 리뉴얼 시, 꼭 반영하도록 하겠습니다.</p>
		{{ Form::close() }}
	</div>
	@endif
</div><!--/.feedback-wrapper-->
@stop

@section('footer_scripts')
@stop