@extends('mockup.layout')

@section('head_title')
Single page mockup
@stop

@section('content')
@include('mockup.top-slider')
<div class="breadcrumbs">
	전체보기(VIEW ALL) <span class="caret-right"></span> CAMPUS <span class="caret-right"></span> 덕성여자대학교
</div>

<div class="single-container row">
	<div id="photoCol" class="photo-col col-xs-12 col-sm-7">
		<nav class="content-nav clearfix">
			<a href="" alt="" class="prev"><span class="glyphicon glyphicon-chevron-left"></span> Pref</a>
			<a href="" alt="" class="next">Next <span class="glyphicon glyphicon-chevron-right"></span></a>
		</nav>

		<figure class="primary-photo pinned">
			<button type="button" class="like-btn">LIKE</button>
			<span class="likes">398</span>
			<button type="button" class="fb-share-btn">f</button>
			<div class="pin-container">
				<a href="http://uk.accessorize.com/" target="_blank" class="pin-link" style="left: 304px;top: 242px;" data-pin-no="1">1</a>
				<a href="http://www.louisvuitton.com/" target="_blank" class="pin-link" style="left: 125px;top: 377px;" data-pin-no="2">2</a>
				<a href="http://www.fendi.com/kr/ko" target="_blank" class="pin-link" style="left: 263px;top: 629px;" data-pin-no="3">3</a>
			</div>
			<img src="{{asset('mockup-assets/sample-content/1.jpg')}}" alt="" />
		</figure><!--/.primary-photo-->

		<figure>
			<img src="{{asset('mockup-assets/sample-content/1-1.jpg')}}" alt="" />
		</figure>

		<figure>
			<img src="{{asset('mockup-assets/sample-content/1-2.jpg')}}" alt="" />
		</figure>

		<figure>
			<img src="{{asset('mockup-assets/sample-content/1-3.jpg')}}" alt="" />
		</figure>

		<figure>
			<img src="{{asset('mockup-assets/sample-content/1-4.jpg')}}" alt="" />
		</figure>
	</div><!--/#photoCol-->
	<div id="dataCol" class="data-col col-xs-12 col-sm-5">
		<div class="icon-section">
			<h3 class="name">이하경</h3>
			<h3 class="category">덕성여자대학교 / 정보통계학과</h3>
		</div>

		<div class="notes-section">
			<h4>She says:</h4>
			<div class="icon-comment">
				<p>저는 사람 만나는 것 되게 좋아해요. 그래서, 대외활동도 굉장히 열심히 했구요. CORES라는 모임에도 소속되어 파티도 하고, 여러가지 활동을 하고 있습니다.</p>
				<p>미소국가대표가 가장 기억에 남아요. 전국 다양한 명소를 놀러 다닐 수 있었던 좋은 기회였어요.</p>
			</div>
			<h4>Photographer's note:</h4>
			<div class="photographers-note">
				<p>덕성여대 비주얼 하경양 고마워요!!!</p>
			</div>
		</div><!--/.notes-section-->

		<div class="pins-section">
			<ul class="pin-list">
				<li><a href="http://uk.accessorize.com/" target="_blank" alt="" class="commerce-link" data-pin-no="1"><span class="pin-numbering">1</span> <strong class="item-name">Bracelet</strong> <span class="vendor">Accessorize</span> in <span class="category">Accessories</span></a></li>
				<li><a href="" alt="http://www.louisvuitton.com/" target="_blank" class="commerce-link" data-pin-no="2"><span class="pin-numbering">2</span> <strong class="item-name">Bag</strong> <span class="vendor">Louis Vuitton</span> in <span class="category">Bags</span></a></li>
				<li><a href="http://www.fendi.com/kr/ko" target="_blank" alt="" class="commerce-link" data-pin-no="3"><span class="pin-numbering">3</span> <strong class="item-name">Shoes</strong> <span class="vendor">Fendi</span> in <span class="category">Shoes</span></a></li>
			</ul>
		</div>

		<div class="photographer-section">
			<img src="{{asset('mockup-assets/sample-content/author.jpg')}}" alt="" class="profile-img" />
			<div class="profile-data">
				<strong class="name">미란다 커</strong>
				<p>MY PAGE <a href="http://camscon.kr">http://camscon.kr</a></p>
				<p>Blog <a href="http://blog.naver.com/camscon">http://blog.naver.com/camscon</a></p>
				<p>Site <a href="">-</a></p>
				<p>Instagram <a href="">@mirandaKerr</a></p>
			</div>
		</div>
	</div>
</div><!--/.list-view-->
@stop

@section('footer_scripts')
<script type="text/javascript">

</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.pin-container').find('.pin-link').hover(function() {
		$('.pin-list .commerce-link').removeClass('highlight');
		var pinNo=$(this).attr('data-pin-no');
		$('.pin-list').find('.commerce-link[data-pin-no="'+pinNo+'"]').addClass('highlight');
	}, function() {
		$('.pin-list .commerce-link').removeClass('highlight');
	});

	$('.pin-list .commerce-link').hover(function() {
		$('.pin-container .pin-link').removeClass('highlight');
		var pinNo=$(this).attr('data-pin-no');
		$('.pin-container').find('.pin-link[data-pin-no="'+pinNo+'"]').addClass('highlight');
	}, function() {
		$('.pin-container .pin-link').removeClass('highlight');
	});
});//document.ready()
</script>
@stop