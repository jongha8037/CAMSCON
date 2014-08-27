<div class="user-profile" style="background-image:url('{{Auth::user()->profileImage->url}}')">
	<div class="user-nickname dropdown">
		<a href="#" data-toggle="dropdown">{{Auth::user()->nickname}} <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li><a href="{{action('UserController@logoutUser')}}">Logout</a></li>
		</ul>
	</div>
</div>