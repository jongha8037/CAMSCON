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

<link rel="stylesheet" type="text/css" href="{{asset('front-assets/user-feedback/form.css')}}">
@stop

@section('content')
<div class="feedback-wrapper clearfix">
	@if(Session::get('proc_result')==='success')
	<div class="success-wrapper">
		<div class="success-message">
			<p>소중한 의견이 접수되었습니다 :) <br /> 다시 한 번, 감사드립니다. <br /> 지적해주신 부분은 꼭꼭 개선할게요!</p>
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