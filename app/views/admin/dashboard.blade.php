@extends('admin.layouts.admin-master')

@section('head_title')
Admin Dashboard
@stop

@section('head_styles')
@stop

@section('content')
<div class="col-xs-12">
<h1>Dashboard</h1>
<dl class="dl-horizontal">
	<dt>총 가입자</dt>
	<dd>{{$user_total}}</dd>
	<dt>오늘 가입자</dt>
	<dd>{{$user_today_total or 0}}</dd>
	<dt>총 스냅 수</dt>
	<dd>{{$snap_total}}</dd>
	<dt>오늘 업로드된 스냅 수</dt>
	<dd>{{$snap_today_total or 0}}</dd>
</dl>
</div>
@stop

@section('footer_scripts')
@stop