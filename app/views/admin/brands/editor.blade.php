@extends('admin.layouts.admin-master')

@section('head_title')
Fashion Brands: Dashboard
@stop

@section('head_styles')
<!-- <link href="{{asset('admin-assets/style-icon/editor.css')}}" rel="stylesheet" /> -->
<style type="text/css"></style>
@stop

@section('content')
<!--Brand list section-->
<div class="col-xs-3">
	<h2 class="admin-section-title">브랜드 목록</h2>
	<a href="{{action('BrandsController@showEditor','new')}}" class="btn btn-primary">새 브랜드 추가</a>
	<ul id="brandList" class="brand-list">
		<?php var_dump($brands); ?>
	</ul>
</div>
<!--/Brand list section-->

<!--Editor section-->
<div class="col-xs-9">
	<h2 class="admin-section-title">패션 브랜드 에디터</h2>
</div>
<!--/Editor section-->
@stop

@section('footer_scripts')
<!-- <script src="{{asset('admin-assets/style-icon/editor.js')}}"></script> -->
<script type="text/javascript"></script>
@stop