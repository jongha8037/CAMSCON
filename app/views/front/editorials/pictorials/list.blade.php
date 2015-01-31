@extends('front.layouts.master')

@section('head_title')
CAMSCON Pictorials
@stop

@section('head_styles')
<!--FB Open Graph tags-->
<meta property="og:title" content="CAMSCON Pictorials" />
<meta property="og:site_name" content="CAMSCON" />
<meta property="og:url" content="{{url('editorials/pictorials')}}" />
<meta property="og:description" content="캠스콘 픽토리얼" />
<meta property="og:image" content="http://cdn.camscon.kr/front-assets/layouts/fb_og.jpg" />
<meta property="fb:app_id" content="562009567255774" />
<meta property="og:locale" content="ko_KR" />

<style type="text/css">
.pictorial-listview .pictorial-list {
	list-style-type:none;
	padding:0px;
}

.pictorial-listview .pictorial-list li {
	border-bottom:1px solid #aaa;
	padding:60px 0px;
}

.pictorial-listview .pictorial-list .entry-wrapper {
	max-width: 800px;
	margin:0px auto;
}

.pictorial-listview .pictorial-list .entry-wrapper header {
	text-align: center;
}

.pictorial-listview .pictorial-list .entry-wrapper h3 {
	font-size:33px;
}

.pictorial-listview .pictorial-list .entry-wrapper a.fullpost-btn {
	margin:25px 0px;
}

.pictorial-listview .pictorial-list .entry-wrapper figure img {
	max-width: 100%;
	height:auto;
}
</style>
@stop

@section('content')
<div class="pictorial-listview">
	<ol class="pictorial-list">
		@foreach($pictorials as $pictorial)
		<li>
			<div class="entry-wrapper">
				<header>
					<h3>{{{$pictorial->title}}}</h3>
					<div class="meta">
						<span>{{$pictorial->pretty_date}}</span>
						<span>|</span>
						<span>Pictorial</span>
					</div>
					<a class="btn btn-default fullpost-btn" href="{{url('editorials/pictorials/'.$pictorial->id)}}">VIEW FULL POST</a>
				</header>
				<figure>
					<img src="{{$pictorial->attachments->first()->url}}" />
				</figure>
			</div>
		</li>
		@endforeach
	</ol>
</div><!--/.pictorial-listview-->
@stop