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
@stop

@section('content')
<div class="feedback-wrapper">
	<form>
		<h1>CAMSCON을 이용하시는 데에 <strong>불편하신 점</strong>을 모두 말씀해주세요</h1>
		<textarea></textarea>
		<div class="submit-bar">
			<button type="submit">제출하기</button>
		</div>
		<p>조금이라도 불편하시거나, 오류가 발생할 때, CAMSCON에 건의하거나 제안해주고 싶은 사항이 있으시다면 아래에 내용을 입력해 제출해주세요 :) 바로 반영하여 수정하거나 리뉴얼 시, 꼭 반영하도록 하겠습니다.</p>
	</form>
</div><!--/.feedback-wrapper-->
@stop

@section('footer_scripts')
@stop