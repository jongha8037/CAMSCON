@extends('front.layouts.master')

@section('head_title')
Camtographer Season 7 Recruiting - CAMSCON
@stop

@section('head_styles')
<!--FB Open Graph tags-->
<meta property="og:title" content="캠토그래퍼 시즌7 모집 공고" />
<meta property="og:site_name" content="CAMSCON" />
<meta property="og:url" content="{{url('recruiting/season-7')}}" />
<meta property="og:description" content="캠토그래퍼 시즌7 프로그램에 참여할 패션을 사랑하는 대학생들을 모집합니다" />
<meta property="og:image" content="http://cdn.camscon.kr/front-assets/recruiting/season7/fb_og.jpg" />
<meta property="fb:app_id" content="562009567255774" />
<meta property="og:locale" content="ko_KR" />

<style type="text/css">
.recruiting section {
	margin:40px 0px;
}

.recruiting section:first-child {
	margin-top:0px;
}

.recruiting figure {
	margin:0px -15px;
}

.recruiting figure img {
	max-width: 100%;
	height:auto;
}

.recruiting figure figcaption {
	text-align: center;
	font-size: 11px;
	font-style: italic;
	color: #888;
}

.recruiting blockquote {
	font-size: 12px;
	margin: 20px 0px;
	border: none;
	font-style: italic;
	background-color: #eee;
	border-radius: 4px;
}

.recruiting blockquote:before {
	font-family:"fontello";
	content:"\e800";
	font-size: 22px;
	font-style: normal;
	float: left;
	margin-right: 9px;
}

.recruiting .section-5 .intro-list {
	list-style-type: none;
	padding-left: 0px;
}

.recruiting .section-5 .intro-list h4 {
	margin: 20px 0px 10px 0px;
}

.recruiting .section-5 .intro-list ul {
	list-style-type: none;
	padding-left:18px;
}

.recruiting .section-5 .intro-list ul li {
	margin-bottom:10px;
	font-size: 13px;
}

.recruiting .section-5 .schedule li, 
.recruiting .section-5 .guide li, 
.recruiting .section-5 .tips li {
	margin-bottom:10px;
	font-size:13px;
}
.recruiting .section-5 .schedule {
	list-style-type: none;
	padding-left: 18px;
}
.recruiting .section-5 .guide {
	list-style-type: none;
	padding-left: 18px;
}
.recruiting .section-5 .tips {
	list-style-type: none;
	padding-left: 18px;
}

@media (min-width:768px) {
	.recruiting figure {
		margin:0px;
	}

	.recruiting figure figcaption {
		font-size:12px;
	}

	.recruiting section .section-body {
		max-width: 600px;
		margin:0px auto;
	}

	.recruiting section:first-child .section-body {
		max-width: none;
	}

	.recruiting section.section-3 p {
		margin-bottom:5px;
	}
}

@media (min-width: 992px) {
	.recruiting figure figcaption {
		font-size: 14px;
		text-align: right;
	}

	.recruiting section {
		position: relative;
	}

	.recruiting section.section-1 .section-body {
		position: absolute;
		top: 493px;
		color: #fff;
		width: 400px;
		right: 52px;
		background-color: rgba(0,0,0,0.75);
		padding: 25px;
	}

	.recruiting section.section-3 .section-body h2 {
		position: absolute;
		top: 0px;
		left: 14px;
		color: #fff;
		font-weight: 700;
		font-size: 36px;
	}

	.recruiting section.section-3 .section-body .row {
		position: absolute;
		top: 67px;
		left: 14px;
		color: #fff;
		font-weight: 700;
		width: auto;
	}

	.recruiting section.section-3 .section-body .left-col {
		margin-bottom:20px;
	}

	.recruiting section.section-4 .section-body {
		position: absolute;
		bottom: 46px;
		color: #fff;
		width: 400px;
		right: 32px;
		background-color: rgba(0,0,0,0.75);
		padding: 25px;
	}

	.recruiting section.section-6 .section-body {
		position: absolute;
		top: 228px;
		width: auto;
		left: 199px;
	}

	.recruiting section.section-6 .section-body a {
		margin: 0px;
		font-size: 23px;
	}
}

@media (min-width:1200px) {
	.recruiting section .section-body {
		max-width:720px;
	}

	.recruiting section .section-body p {
		font-size:15px;
		line-height: 1.6;
	}

	.recruiting section.section-1 .section-body {
		top:552px;
		width:595px;
		padding:30px;
	}

	.recruiting section.section-1 .section-body h2 {
		font-size:33px;
	}
	.recruiting section.section-1 .section-body p {
		
	}

	.recruiting blockquote {
		max-width: 600px;
		margin: 20px auto;
	}

	.recruiting section.section-3 .section-body h2, 
	.recruiting section.section-3 .section-body .row {
		position: static;
		font-weight: 400;
	}
	.recruiting section.section-3 .section-body {
		position: absolute;
		bottom: 35px;
		color: #fff;
		width: 362px;
		right: 15px;
		background-color: rgba(0,0,0,0.75);
		padding: 22px;
	}

	.recruiting .section-5 .intro-list ul li,
	.recruiting .section-5 .schedule li, 
	.recruiting .section-5 .guide li, 
	.recruiting .section-5 .tips li {
		font-size:14px;
	}

	.recruiting section.section-6 .section-body {
		top: 249px;
	}
	.recruiting section.section-6 .section-body a {
		font-size:30px;
	}
}
</style>
@stop

@section('content')
<div class="recruiting">
	<section class="section-1">
		<figure class="head-hero">
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/hero.jpg" />
			<figcaption>캠토그래퍼 이채령(전남대), 조유경(전주대)</figcaption>
		</figure>

		<div class="section-body">
			<h2>Looking for SEASON7 CAMTOGRAPHERS</h2>

			<p>캠토그래퍼(CAMTOGRAPHER)는 '캠퍼스 포토그래퍼'의 줄임말로 패션소셜매거진 캠스콘이 매학기 단위로 대학생을 대상으로 운영하는 교육/실습 프로그램입니다.</p>
			<p>70만원짜리 셔츠, 200만원짜리 코트를 캠퍼스패션이라고 제안하는 기성잡지에 대한 반항정신을 기반으로, 있는 그대로의 캠퍼스패션을 보여주자는 취지에서 시작되었습니다.</p>
			<p>2011년 여름, 한양대를 시작으로 서울 8개 주요대학에서 학생들의 자발적인 참여로 확산되었고 해가 거듭할수록 패션과 멋을 사랑하는 대학생들의 참여가 많아져 현재는 전국 80여개, 해외 10여개 캠퍼스, 누적인원 294명의 대학생들이 이 움직임에 동참하였습니다.</p>
		</div>
	</section>

	<blockquote>모든 사진은 캠토그래퍼 시즌6에 참여하였던 대학생들의 사진이고, Fashion Pictorial Campaign을 통해 촬영한 사진입니다. FPC를 통해, 자신의 생각을 픽토리얼을 통해 표현하고 발현하는 연습을 하였습니다.</blockquote>

	<section class="section-2">
		<figure>
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/1.jpg" />
			<figcaption>캠토그래퍼 정예하(서울대), 최원정(단국대)</figcaption>
		</figure>

		<div class="section-body">
			<h2>Benefits</h2>
			<p>시즌6까지 과정을 수료하며 캠토그래퍼는 패션과 멋을 사랑하는 대학생들 사이에서 최고의 네트워크를 형성하고 있습니다. 많은 대학생들이 캠토그래퍼 프로그램을 통해 자신의 꿈을 찾고, 사진과 스타일링에 대한 이해와 숙련도를 높였으며 자신이 무엇을 좋아하는지 알게 되었습니다. 그리고, 이 과정을 통해 많은 대학생들이 패션업계의 MD, 패션마케터, 디자이너, 에디터, 스타일리스트, 포토그래퍼 등의 Professional Job으로 진출하고 있으며 '캠토그래퍼'는 패션업계에 진출하는 등용문의 역할을 하고 있습니다.</p>
			<p>우리는 자신의 학교에서 가장 스타일리시한 18명의 대학생을 취재하고 카메라와 촬영, 패션에 대해 심도있게 학습하며 패션을 좋아하는 대학생들끼리 모여 활발하게 네트워킹하는 캠토그래퍼 시즌7 프로그램에 참여할 사람들을 찾고 있습니다. 수많은 젊음들의 가장 아름다운 시기를 기록하고, 대학시절 가장 재밌게 놀며 많은 배움과 인연을 얻을 수 있는 이 기회를 놓치지 마세요!</p>
		</div>
	</section>

	<section class="section-3">
		<figure>
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/2.jpg" />
			<figcaption>캠토그래퍼 최원정(단국대), 유민욱(국민대)</figcaption>
		</figure>

		<div class="section-body">
			<h2>5 Principles</h2>

			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-12 left-col">
					<ol style="padding-left: 44px;font-size: 16px;">
						<li>Attitude</li>
						<li>Fashion Sense</li>
						<li>Passion for Fashion</li>
						<li>Skill Sets to Photograph</li>
						<li>Sociability</li>
					</ol>

					<p>우리는 위의 5가지 요소를 중요하게 생각합니다.</p>
					<p>사용할 수 있는 카메라는 있어야 합니다.</p>
					<p>사진과 보정에 대한 지식이 있으면 좋습니다.</p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-12 right-col">
					<p>
						<b>다음과 같은 사항은 중요하지 않습니다.</b>
						<ol>
							<li>개인블로그나 SNS채널의 방문자수</li>
							<li>다른 활동이나 프로그램 참여경력</li>
						</ol>
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section-4">
		<figure>
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/3.jpg" />
			<figcaption>캠토그래퍼 서희원(한국외대), 인선모(중앙대-안성)</figcaption>
		</figure>

		<div class="section-body">
			<h2>Program Information</h2>

			<p>당신이 5개월간 직접 촬영하고 선정한 18명의 사진, 그리로 생각과 철학을 표현하는 픽토리얼 사진으로 당신의 패션에 대한 감각과 안목, 열정을 직접 증명하세요. 'That's all', 그게 전부입니다.</p>
		</div>
	</section>

	<section class="section-5">
		<figure>
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/4.jpg" />
			<figcaption>캠토그래퍼 서서린(영남대)</figcaption>
		</figure>

		<div class="section-body">
			<h3>[프로그램 안내]</h3>
			<ol class="intro-list">
				<li>
					<h4>1. 교육 프로그램</h4>
					<ul>
						<li>Kick-off Workshop : 2/23(월) 오후2시 ~ 2/24(화) @양평밸리 (경기도 양평군 소재)</li>
						<li>Campus Photography 개론, DSLR과 렌즈의 이해, 포토샵 리터칭 및 각종 보정툴 다루기 등의 이론수업진행</li>
						<li>촬영, 보정 현장실습과 피드백</li>
						<li>주간야외촬영실습 : 3/15(일) 오후2시~, @여의도한강공원, 야외촬영실습</li>
						<li>패션픽토리얼의 이해 : 5/9(토) 오후7시~, @양재 L스튜디오</li>
						<li>보충수업 : 3월중순~4월초, 매주토요일 A,B,C,D반 수준별로 나누어 진행</li>
					</ul>
				</li>

				<li>
					<h4>2. 촬영/실습 프로그램</h4>
					<ul>
						<li>Campus Photography 촬영(메인활동) : 한 학기동안 총 18명의 우리학교의 스타일리시한 대학생을 취재</li>
						<li>Fashion Pictorial Campaign(수료과제) : 4명이 팀을 이루어 자유주제 및 스타일링으로 패션 픽토리얼 촬영</li>
					</ul>
				</li>

				<li>
					<h4>3. 기타</h4>
					<ul>
						<li>소셜파티나 네트워킹, 러닝같은 다양한 행사들이 이루어집니다.</li>
						<li>패션브랜드들과 콜라보레이션, 패션기업 인턴십 주선 등 다양한 기회가 제공됩니다.</li>
					</ul>
				</li>
			</ol>

			<h3>[선발일정]</h3>
			<ol class="schedule">
				<li>1차 서류접수 : 1/23(금)~2/11(수)</li>
				<li>2차 인터뷰대상자통보 : 2/12(목) 저녁11시</li>
				<li>2차 인터뷰 : 2/13(금)~2/15(일) @캠스콘플레이스(홍대정문 인근)</li>
			</ol>

			<h3>[지원방법]</h3>
			<ul class="guide">
				<li>하단의 'Download Application' 링크를 이용하여 지원서를 다운로드 받아 recruiting@camscon.kr로 보내주시면 됩니다.</li>
				<li>보내주실 때 메일제목 및 파일명 : [학교_이름], 예시) [한국대학교_홍길동]</li>
			</ul>

			<h3>[참고사항]</h3>
			<ul class="tips">
				<li>서울과 인천, 경기 소재학교 학생들이나 지방의 학교를 다니더라도 서울에 거주하는 합격자들은 2/23(월)~2/24(화) 양일간 양평밸리에서 진행되는 Kick-off Workshop에 필수적으로 참여해야 합니다. 참여가 불가능한 분은 다음 시즌에 지원해주시기 바라며, 불참 시 합격이 취소됩니다. (지방소재 학생들도 희망 시 참여가능하나 교통비가 지원되지는 않으며 지역별로 2월말~3월초에 워크샵을 실시할 예정입니다.)</li>
				<li>인터뷰는 현장인터뷰와 전화인터뷰형태로 진행되며, 합격하신 분들은 추후 어떤 형태로 진행되는지 알려드립니다. (지방소재 대학교의 지원자는 전화인터뷰로 진행이 됩니다.)</li>
				<li>1차 서류접수와 2차 인터뷰에서 떨어지신 분들은 불합격사실을 별도로 통보해드리지 않습니다.</li>
				<li>활동기간은 올해 3월부터 7월까지이며 한 학교당 최대 1명이 선발됩니다.</li>
				<li>1차서류접수를 통해 학교별로 최대2명씩 2차인터뷰 대상자가 선정되며, 인터뷰시간은 13일 저녁부터 15일 저녁까지 학교의 가나다역순으로 배치되니 참고해주시기 바랍니다. (홍익대로 시작되어 가천대로 끝납니다.)</li>
				<li>문의사항이 있으시거나 지원서가 다운로드되지 않는 분들께서는 캠스콘 페이지(www.facebook.com/camscon)나 메일(recruiting@camscon.kr)으로 문의/요청해주시면 감사하겠습니다.</li>
			</ul>
		</div>
	</section>

	<section class="section-6">
		<figure>
			<img src="http://cdn.camscon.kr/front-assets/recruiting/season7/5.jpg" />
			<figcaption>캠토그래퍼 김가람(세종대)</figcaption>
		</figure>

		<div class="section-body" style="text-align:center;">
			<a href="{{asset('front-assets/recruiting/season7/University_Name.pptx')}}" class="btn btn-primary" style="margin:17px 0px;"><span class="glyphicon glyphicon-save"></span> Download Application</a>
		</div>
	</section>
</div>
@stop