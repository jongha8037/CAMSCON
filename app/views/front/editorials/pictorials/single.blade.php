@extends('front.layouts.master')

@section('head_title')
CAMSCON Pictorial - {{{$pictorial->title}}}
@stop

@section('head_styles')
<!--FB Open Graph tags-->
<meta property="og:title" content="CAMSCON Pictorial - {{{$pictorial->title}}}" />
<meta property="og:site_name" content="CAMSCON" />
<meta property="og:url" content="{{url('editorials/pictorials/'.$pictorial->id)}}" />
<meta property="og:description" content="{{{$pictorial->text}}}" />
<meta property="og:image" content="{{$pictorial->attachments->first()->url}}" />
<meta property="fb:app_id" content="562009567255774" />
<meta property="og:locale" content="ko_KR" />

<style type="text/css">
.pictorial-singleview {
	max-width: 800px;
	margin:0px auto;
}

.pictorial-singleview header {
	text-align: center;
	margin:65px 0px;
}

.pictorial-singleview header h3 {
	font-size:33px;
}

.pictorial-singleview figure {
	margin:15px 0px;
}

.pictorial-singleview footer {
	margin:30px;
	text-align: center;
	font-size:15px;
}
</style>
@stop

@section('content')
<div class="pictorial-singleview">
	<header>
		<h3>{{{$pictorial->title}}}</h3>
		<div class="meta">
			<span>{{$pictorial->pretty_date}}</span>
			<span>|</span>
			<span>Pictorial</span>
		</div>
	</header>
	
	@foreach($pictorial->attachments as $attachment)
	<figure>
		<img src="{{$attachment->url}}" />
	</figure>
	@endforeach

	@if($pictorial->text)
	<footer>{{{$pictorial->text}}}</footer>
	@endif
</div><!--/.pictorial-singleview-->
@stop