@extends('front.layouts.master')

@section('head_styles')
@stop

@section('content')
<html>
<head>
	<style type="text/css">

	.inspirer-container {
		margin:auto;
	}

	.inspirer-profilebox {
		float:left;
		color:#7f8c8d;
		border:1px solid;
		width:28%;
		margin-left:4%;
		margin-top: 44px;
		margin-bottom: 30px;
	}

	.inspirer-profiledata {
		display:none;
	}

	.inspirer-profileintro {
		height:90px;
		max-width:150px;
		display:table-cell;
		vertical-align:middle;
		overflow:hidden;
		word-wrap:break-word;
		color:#6A6A6A;
	}

	.inspirer-profileintro-inner {
		margin:0;
		max-height:60px;
		overflow:hidden;
	}

	.inspirer-profilename, .inspirer-profileicon {
		text-align: center;
		color:#363841;
	}

	.inspirer-profilename-sub1, .inspirer-profilename-sub2, .inspirer-profilename-sub3 {
		display:inline-block;
		overflow:hidden;
		text-overflow:ellipsis;
		white-space:nowrap;
	}

	.inspirer-profilename-sub1 {
		width:45%;
	}

	.inspirer-profilename-sub3 {
		width:32%;
	}

	.inspirer-profileicon-inner1 {
		float:left;
		margin-left:26px
	}

	.inspirer-profileicon-inner2, .inspirer-profileicon-inner3 {
		float:left;
		margin-left:4px;	
	}

	.iconsize {
		font-size:20px;
	}

	.inspirer-profileiconname {
		font-size:12px;
		margin:4px;
	}

	@media (max-width:360px){.inspirer-profilename {font-size:9px;margin-top: 4px;min-height:15px;}}
	@media (min-width:361px) and (max-width:399px){.inspirer-profilename {font-size:10px;margin-top: 4px;min-height:18px;}}
	@media (min-width:400px) and (max-width:439px){.inspirer-profilename {font-size:10px;margin-top: 5px;min-height:18px;}}
	@media (min-width:440px) and (max-width:479px){.inspirer-profilename {font-size:11px;margin-top: 5px;min-height:18px;}}
	@media (min-width:480px) and (max-width:519px){.inspirer-profilename {font-size:11px;margin-top: 5px;min-height:18px;}}
	@media (min-width:520px) and (max-width:559px){.inspirer-profilename {font-size:12px;margin-top: 5px;min-height:18px;}}
	@media (min-width:560px) and (max-width:599px){.inspirer-profilename {font-size:13px;margin-top: 7px;min-height:25px;}}
	@media (min-width:600px) and (max-width:639px){.inspirer-profilename {font-size:13px;margin-top: 7px;min-height:25px;}}
	@media (min-width:640px) and (max-width:679px){.inspirer-profilename {font-size:14px;margin-top: 7px;min-height:25px;}}
	@media (min-width:680px) and (max-width:719px){.inspirer-profilename {font-size:14px;margin-top: 9px;min-height:30px;}}
	@media (min-width:720px) and (max-width:759px){.inspirer-profilename {font-size:14px;margin-top: 9px;min-height:30px;}}
	@media (min-width:760px) and (max-width:767px){.inspirer-profilename {font-size:14px;margin-top: 9px;min-height:30px;}}
   
	@media (min-width:768px) {
		.inspirer-container {
			width:697px;
		}

		.inspirer-profilebox {
			width:200px;
			margin-left:15px;
			margin-right:15px;
			margin-top: 50px;
			height:390px;
		}

		.inspirer-profiledata {
			display:block;
		}

		.inspirer-profilename {
			height:20px;
			margin-top:15px;
		}
	}

	@media (min-width:992px) {
		.inspirer-container {
			width:928px;
		}

		.inspirer-profilebox {
			width:200px;
			margin-left:15px;
			margin-right:15px;
			margin-top: 50px;
			height:390px;
		}

		.inspirer-profiledata {
			display:block;
		}

		.inspirer-profilename {
			height:20px;
			margin-top:15px;
		}
	}

	@media (min-width:1200px) {
		.inspirer-container {
			width:1170px;
		}

		.inspirer-profilebox {
			width:200px;
			margin-left:18px;
			margin-right:15px;
			margin-top: 50px;
			height:390px;
		}

		.inspirer-profiledata {
			display:block;
		}

		.inspirer-profilename {
			height:20px;
			margin-top:15px;
		}
	}

	div img {
		max-width: 100%
	} 

	</style>
</head>
<body>
	<div class="inspirer-container">
		@foreach($users as $user)
		<div class="inspirer-profilebox">			
			<div>
			@if ($user->profileImage)
				<img src="{{$user->profileImage->url}}">
			@else
				<img src="/img/05.jpg">
			@endif
			</div>
			<div class="inspirer-profilename">
				<strong>
					<span class="inspirer-profilename-sub1">{{$user->nickname}}</span>
					<span class="inspirer-profilename-sub2">&nbsp|</span>
					<span class="inspirer-profilename-sub3"><i class="icon-camera-1"></i>&nbsp{{$user->snaps->count()}}</span>
				</strong>
			</div>
	<!--{{--@if (($users->inspirer-profiledata) != NULL)
			<div align="center" class="inspirer-profiledata">
				<div class="inspirer-profileintro">
					<p class="inspirer-profileintro-inner">aaaaa</p>
				</div>
			</div>
			@else --}}-->
			<div align="center" class="inspirer-profiledata">
				<div class="inspirer-profileintro">
					<p class="inspirer-profileintro-inner" style="font-style:italic">CAMSCON Inspirer</p>
				</div>
			</div>
	<!--{{--	@endif--}}-->
			<div class="inspirer-profiledata inspirer-profileicon">
				<div class="inspirer-profileicon-inner1">
					<a href="profile/{{$user->id}}">
						<div><i class="icon-user iconsize"></i></div>
						<div class="inspirer-profileiconname">profile</div>
					</a>
				</div>
				
				@if (($user->instagram) != NULL)
				<div class="inspirer-profileicon-inner2">
					<a href="http://instagram.com/{{$user->instagram}}">
						<div><i class="icon-instagramm iconsize"></i></div>
						<div class="inspirer-profileiconname">instagram</div>
					</a>
				</div>
				@else
				<div class="inspirer-profileicon-inner2" style="color:#BEBBB4">
					<div><i class="icon-instagramm iconsize"></i></div>
					<div class="inspirer-profileiconname">instagram</div>
				</div>
				@endif

				@if (($user->instagram) != NULL)
				<div class="inspirer-profileicon-inner3">
					<a href="{{$user->blog}}">
						<div><i class="icon-pencil iconsize"></i></div>
						<div class="inspirer-profileiconname">blog</div>
					</a>
				</div>
				@else
				<div class="inspirer-profileicon-inner3" style="color:#BEBBB4">
					<div><i class="icon-pencil iconsize"></i></div>
					<div class="inspirer-profileiconname">blog</div>
				</div>
				@endif
			</div>
		</div>
		@endforeach
	</div>
</body>
</html>
@stop

@section('footer_scripts')
@stop