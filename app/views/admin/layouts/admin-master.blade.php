<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('head_title','Campus Style Icon')</title>

	<!-- Bootstrap -->
	<link href="{{asset('packages/bootstrap-3.2.0/css/bootstrap.min.css')}}" rel="stylesheet" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--Admin Layout styles-->
	<link href="{{asset('admin-assets/layouts/admin-master.css')}}" rel="stylesheet" />

	@yield('head_styles')
	</head>
<body>
	<header class="admin-header container">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#">대시보드</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					스타일 아이콘 관리 <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">업로드</a></li>
				</ul>
			</li>
		</ul>
	</header>

	<div class="admin-body container">
		@yield('content')
	</div><!--/.admin-body-->

	<footer class="admin-footer container">
		<div class="admin-footer-content">
			<a href="" class="btn btn-default btn-xs admin-logout-btn">로그아웃</a>
		</div>
	</footer>

	<!-- jQuery 1.11.1 -->
	<script src="{{asset('packages/jquery-1.11.1/jquery-1.11.1.min.js')}}"></script>
	<!-- Bootstrap 3.2.0 -->
	<script src="{{asset('packages/bootstrap-3.2.0/js/bootstrap.min.js')}}"></script>
	<!--Verge.js-->
	<script src="{{asset('packages/verge/verge.min.js')}}"></script>
	<script type="text/javascript">
		jQuery.extend(verge);
	</script>
	@yield('footer_scripts')
</body>
</html>