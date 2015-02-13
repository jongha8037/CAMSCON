@extends('front.layouts.master')

@section('head_title')
CAMSCON
@stop

@section('head_styles')
<style type="text/css">
	.inspirers-page {
		margin:auto;
	}

	.inspirers-page .card {
		float:left;
		color:#7f8c8d;
		border:1px solid;
		width:28%;
		margin-left:4%;
		margin-top:44px;
		margin-bottom:30px;
	}

	.inspirers-page .profile-img img {
		max-width:100%;
	}

	.inspirers-page .profile-body span {
		font-weight:bold;
	}

	.inspirers-page .user-nickname, .inspirers-page .inline-divider, .inspirers-page .snap-count {
		display:inline-block;
		overflow:hidden;
		text-overflow:ellipsis;
		white-space:nowrap;
	}

	.inspirers-page .user-nickname {
		width:45%;
	}

	.inspirers-page .inline-divider {
		margin-left:2px;
	}

	.inspirers-page .snap-count {
		width:32%;
	}

	.inspirers-page .user-bio, .inspirers-page .user-links {
		display:none;
		width:80%;
		margin:auto;
	}

	.inspirers-page .inspirer-profileintro {
		height:90px;
		max-width:150px;
		display:table-cell;
		vertical-align:middle;
		overflow:hidden;
		word-wrap:break-word;
		color:#6A6A6A;
	}

	.inspirers-page .inspirer-profileintro p {
		margin:0px;
		max-height:60px;
		overflow:hidden;
		text-align:center;
	}

	.inspirers-page .profile-body, .inspirers-page .user-links {
		text-align:center;
		color:#363841;
	}

	.inspirers-page .user-links i {
		display:block;
		font-size:20px;
	}

	.inspirers-page .profile-link, .inspirers-page .instagram-link, .inspirers-page .blog-link {
		display:inline-block;
	}

	.inspirers-page .link-caption {
		font-size:12px;
		margin:4px;
	}

	.inspirers-page .fontstyle {
		font-style:italic;
	}

	.inspirers-page .iconcolor {
		color:#BEBBB4;
	}

	@media (max-width:360px) {
		.inspirers-page .profile-body {
			font-size:9px;
			margin-top:4px;
			min-height:15px;
		}
	}

	@media (min-width:361px) and (max-width:399px) {
		.inspirers-page .profile-body {
			font-size:10px;
			margin-top:4px;
			min-height:18px;
		}
	}

	@media (min-width:400px) and (max-width:439px) {
		.inspirers-page .profile-body {
			font-size:10px;
			margin-top:5px;
			min-height:18px;
		}
	}

	@media (min-width:440px) and (max-width:479px) {
		.inspirers-page .profile-body {
			font-size:11px;
			margin-top:5px;
			min-height:18px;
		}
	}

	@media (min-width:480px) and (max-width:519px) {
		.inspirers-page .profile-body {
			font-size:11px;
			margin-top:5px;
			min-height:18px;
		}
	}

	@media (min-width:520px) and (max-width:559px) {
		.inspirers-page .profile-body {
			font-size:12px;
			margin-top:5px;
			min-height:18px;
		}
	}

	@media (min-width:560px) and (max-width:599px) {
		.inspirers-page .profile-body {
			font-size:13px;
			margin-top:7px;
			min-height:25px;
		}
	}

	@media (min-width:600px) and (max-width:639px) {
		.inspirers-page .profile-body {
			font-size:13px;
			margin-top:7px;
			min-height:25px;
		}
	}

	@media (min-width:640px) and (max-width:679px) {
		.inspirers-page .profile-body {
			font-size:14px;
			margin-top:7px;
			min-height:25px;
		}
	}

	@media (min-width:680px) and (max-width:719px) {
		.inspirers-page .profile-body {
			font-size:14px;
			margin-top:9px;
			min-height:30px;
		}
	}

	@media (min-width:720px) and (max-width:759px) {
		.inspirers-page .profile-body {
			font-size:14px;
			margin-top:9px;
			min-height:30px;
		}
	}

	@media (min-width:760px) and (max-width:767px) {
		.inspirers-page .profile-body {
			font-size:14px;
			margin-top:9px;
			min-height:30px;
		}
	}
   
	@media (min-width:768px) {
		.inspirers-page {
			width:697px;
		}

		.inspirers-page .card {
			width:200px;
			margin-left:15px;
			margin-right:15px;
			margin-top:50px;
			height:390px;
		}

		.inspirers-page .user-bio, .inspirers-page .user-links {
			display:table;
		}

		.inspirers-page .profile-body {
			height:20px;
			margin-top:15px;
		}
	}

	@media (min-width:992px) {
		.inspirers-page {
			width:928px;
		}
	}

	@media (min-width:1200px) {
		.inspirers-page {
			width:1170px;
		}

		.inspirers-page .card {
			margin-left:18px;
		}
	}	
</style>
@stop

@section('content')
<div class="inspirers-page">
	@foreach($users as $user)
	<div class="card">			
		<figure class="profile-img">
		@if($user->profileImage)
			<img src="{{$user->profileImage->url}}" />
		@else
			<img src="/img/05.jpg" />
		@endif
		</figure>
		<div class="profile-body">
			<span class="user-nickname">{{{$user->nickname}}}</span>
			<span class="inline-divider">|</span>
			<span class="snap-count"><i class="icon-camera-1"></i> {{$user->snaps->count()}}</span>
		</div>
		
		<!--after profileintro db, make condition--> 
		<div class="user-bio">
			<div class="inspirer-profileintro">
				<p class="fontstyle">CAMSCON Inspirer</p>
			</div>
		</div>

		<div class="user-links">
			<div class="profile-link"> 
				<a href="{{action('ProfileController@showProfile', $user->id)}}">
					<i class="icon-user"></i>
					<span class="link-caption">profile</span>
				</a>
			</div>
			
			@if($user->instagram)
			<div class="instagram-link">
				<a href="http://instagram.com/{{{$user->instagram}}}">
					<i class="icon-instagramm"></i>
					<span class="link-caption">instagram</span>
				</a>
			</div>
			@else
			<div class="instagram-link iconcolor">
				<i class="icon-instagramm"></i>
				<span class="link-caption">instagram</span>
			</div>
			@endif

			@if($user->blog)
			<div class="blog-link">  
				<a href="{{{$user->blog}}}">
					<i class="icon-pencil"></i>
					<span class="link-caption">blog</span>
				</a>
			</div>
			@else
			<div class="blog-link iconcolor">
				<i class="icon-pencil"></i>
				<span class=" link-caption">blog</span>
			</div>
			@endif
		</div>
	</div>
	@endforeach
</div>
@stop

@section('footer_scripts')
@stop