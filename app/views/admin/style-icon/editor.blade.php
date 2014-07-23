@extends('admin.layouts.admin-master')

@section('head_title')
Style Icon Editor
@stop

@section('head_styles')
<link href="{{asset('admin-assets/style-icon/editor.css')}}" rel="stylesheet" />
@stop

@section('content')
<div class="photo-upload-col col-xs-12 col-sm-6 col-md-7">
	<h2>사진</h2>

	<div id="addPhotoArea" class="add-photo-area">
		<span class="glyphicon glyphicon-camera"></span> <span>사진 추가</span>
	</div><!--/#addPhotoArea-->
</div><!--/.photo-upload-col-->
<div class="meta-input-col col-xs-12 col-sm-6 col-md-5">
	<h2>메타 정보</h2>

	<form role="form">
		<!--Name field-->
		<div class="form-group">
			<label for="iconName">스타일 아이콘 이름</label>
			<input type="text" class="form-control" id="iconName" name="name" placeholder="이름" />
		</div>
		<!--/Name field-->

		<!--Location fields-->
		<div class="form-group">
			<label for="photoCountry">촬영 로케이션</label>
			<div class="photo-location-wrapper">
				<input type="text" class="form-control" id="photoCountry" name="country" placeholder="국가" />
				<input type="text" class="form-control" id="photoCity" name="city" placeholder="도시" />
			</div>
			<input type="text" class="form-control" id="photoStreet" name="street" placeholder="학교 또는 거리" />
		</div>
		<!--/Location fields-->

		<!---->
	</form>
</div><!--/.meta-col-->
@stop

@section('footer_scripts')
<script src="{{asset('admin-assets/style-icon/editor.js')}}"></script>
@stop