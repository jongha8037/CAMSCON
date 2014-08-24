<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('head_title','Camscon')</title>

	<!--jQuery UI-->
	<link href="{{asset('packages/jquery-ui-1.11.0-hot-sneaks-full/jquery-ui.min.css')}}" rel="stylesheet" />

	<!-- Bootstrap -->
	<link href="{{asset('packages/bootstrap-3.2.0/css/bootstrap.min.css')}}" rel="stylesheet" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--Google Web Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />

	<!--Admin Layout styles-->
	<link href="{{asset('front-assets/layouts/master.css')}}" rel="stylesheet" />

	@yield('head_styles')
	</head>
<body>
@include('includes.facebook-sdk')
	<header class="master-header container">
		<!--Logo & Navigation-->
	</header><!--./master-header-->

	<div class="master-body container">
		@yield('content')
	</div><!--/.master-body-->

	<footer class="master-footer container">
		<div class="master-footer-content">
			<!--Copyright and shit-->
		</div>
	</footer>

	<!-- jQuery 1.11.1 -->
	<script src="{{asset('packages/jquery-1.11.1/jquery-1.11.1.min.js')}}"></script>
	<!--jQuery UI-->
	<script src="{{asset('packages/jquery-ui-1.11.0-hot-sneaks-full/jquery-ui.min.js')}}"></script>
	<!-- Bootstrap 3.2.0 -->
	<script src="{{asset('packages/bootstrap-3.2.0/js/bootstrap.min.js')}}"></script>

	<!--Login modal-->
	@if(!Auth::check())
	@include('includes.login-modal', array('tracker'=>Tracker::get()))
	@endif

	<!--Alert/Confirm modals-->
	@include('includes.confirm-modal')
	@include('includes.alert-modal')

	<!--Verge.js-->
	<script src="{{asset('packages/verge/verge.min.js')}}"></script>
	<script type="text/javascript">
		jQuery.extend(verge);
	</script>

	<!--Admin Layout-->
	<script src="{{asset('front-assets/layouts/master.js')}}"></script>
	@yield('footer_scripts')
</body>
</html>