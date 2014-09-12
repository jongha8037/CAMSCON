
<div class="user-profile" style="@if(Auth::user()->profileImage){{'background-image:url(\''.Auth::user()->profileImage->url.'\');'}}@else{{'background-image:url(\''.asset('front-assets/profile/profile_default_small.png').'\');'}}@endif">
	<div class="user-nickname dropdown">
		<a href="#" data-toggle="dropdown">{{Auth::user()->nickname}} <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li><a href="{{action('ProfileController@showProfile', Auth::user()->id)}}">My Page</a></li>
			<li><a href="{{action('UserController@logoutUser')}}">Logout</a></li>
		</ul>
	</div>
</div>