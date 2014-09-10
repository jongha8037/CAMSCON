@extends('front.layouts.master')

@section('head_title')
Camscon
@stop

@section('head_styles')
@stop

@section('content')
@if(!empty($profile->profileCover))
<figure class="profile-cover">
	<img src="{{$profile->profileCover->url}}" />
</figure>
@endif

<div class="profile-data" style="background-image:url(@if($profile->profileImage){{$profile->profileImage->url}}@else{{asset('front-assets/profile/profile_default_big.png')}}@endif);">
	<h3 class="name">{{{$profile->nickname}}}</h3>
	<div class="row">
		<div class="details col-xs-12 col-sm-8">
			@if(!empty($profile->uri))
			<p>MY PAGE <a href="{{action('ProfileController@showProfile', $profile->uri)}}">{{action('ProfileController@showProfile', $profile->uri)}}</a></p>
			@else
			<p>MY PAGE <a href="{{action('ProfileController@showProfile', $profile->id)}}">{{action('ProfileController@showProfile', $profile->id)}}</a></p>
			@endif
			<p>Blog @if(!empty($profile->blog))<a href="{{$profile->blog}}" target="_blank">{{$profile->blog}}</a>@else{{'-'}}@endif</p>
			<p>Instagram @if(!empty($profile->instagram))<a href="http://instagram.com/{{$profile->instagram}}" target="_blank">{{'@'.$profile->instagram}}</a>@else{{'-'}}@endif</p>
		</div>
		<div class="stats col-xs-12 col-sm-4">
			<h3><strong class="stat-value">{{$stats->posts}}</strong> posts</h3>
			<h3><strong class="stat-value">{{$stats->likes}}</strong> likes</h3>
			<h3><strong class="stat-value">{{$stats->comments}}</strong> comments</h3>
		</div>
	</div>
</div>

<div class="profile-filter-tabs">
	<div class="my-collection tab">My Collection</div><div class="my-posts tab">My Posts</div>
</div>
@stop

@section('footer_scripts')

@stop