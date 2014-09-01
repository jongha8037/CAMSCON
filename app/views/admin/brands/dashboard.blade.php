@extends('admin.layouts.admin-master')

@section('head_title')
Fashion Brands: Dashboard
@stop

@section('head_styles')
<link href="{{asset('admin-assets/brands/style.css')}}" rel="stylesheet" />
@stop

@section('content')
<!--Brand list section-->
<div class="col-xs-3">
	@include('admin.brands.list')
</div>
<!--/Brand list section-->

<!--Editor section-->
<div class="col-xs-9">
	<h2 class="admin-section-title">패션 브랜드 대시보드</h2>

	@if(Session::has('delete_success'))
	<div class="alert alert-success"><strong>성공</strong> 브랜드가 삭제되었습니다 :)</div>
	@endif
</div>
<!--/Editor section-->
@stop

@section('footer_scripts')
<script type="text/javascript"></script>
@stop