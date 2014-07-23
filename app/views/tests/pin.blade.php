<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pin test</title>

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

	<link href="{{asset('test/pintest.css')}}" rel="stylesheet" />
	</head>
<body>
	<header class="page-header container">
		<h1>Pin Test</h1>
	</header>

	<div class="page-body container">
		<div class="image-col col-sm-6">
			<div class="image-container-wrapper">
				<div class="image-container view">
					<div class="pin-container"></div><!--/.pin-container-->
				</div><!--/.image-container-->
			</div><!--/.image-container-wrapper-->
		</div><!--/.image-col-->

		<div class="tag-col col-sm-6">
			<button type="button" id="modeToggleBtn" class="btn btn-default">Switch to edit mode</button>
			<div id="pinEditControls">
				<div class="pin-control form-group">
					<select class="form-control">
						<optgroup label="제휴링크">
							<option>네이버 지식쇼핑</option>
							<option>네이버 지식쇼핑</option>
							<option>네이버 지식쇼핑</option>
						</optgroup>
						<optgroup label="스폰서 링크">
							<option>네이버 지식쇼핑</option>
							<option>네이버 지식쇼핑</option>
							<option>네이버 지식쇼핑</option>
						</optgroup>
					</select>
					<input type="text" class="form-control" />
				</div>
			</div><!--/#pinEditControlls-->
		</div>
	</div>

	<!-- jQuery 1.11.1 -->
	<script src="{{asset('packages/jquery-1.11.1/jquery-1.11.1.min.js')}}"></script>
	<!-- Bootstrap 3.2.0 -->
	<script src="{{asset('packages/bootstrap-3.2.0/js/bootstrap.min.js')}}"></script>
	<!--Verge.js-->
	<script src="{{asset('packages/verge/verge.min.js')}}"></script>

	<!--Load default jQueryUI for testing-->
	<script src="{{asset('packages/jquery-ui-1.11.0.default/jquery-ui.min.js')}}"></script>

	<script type="text/javascript">
		jQuery.extend(verge);
	</script>

	<!--Load PinEngine-->
	<script src="{{asset('test/PinEngine.js')}}"></script>

	<script type="text/javascript">
	var ImageData={
		id:"1",
		url:"{{asset('test/sample.jpg')}}",
		primary:{},
		sub:[]
	};

	var PinData=[];//PinData[]

	$(document).ready(function() {
		PinEngine.init();

		$('.tag-col').on('click','#modeToggleBtn',null,function() {
			if(PinEngine.mode=='view') {
				$(this).text('Switch to view mode');
				//switch to edit mode
				PinEngine.editMode();
			} else {
				$(this).text('Switch to edit mode');
				//switch to view mode
				PinEngine.viewMode();
			}
		});
	});//document.ready()
	</script>
</body>
</html>