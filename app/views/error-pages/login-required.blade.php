@extends('front.layouts.master')

@section('head_title')
CAMSCON - 로그인을 해야 합니다
@stop

@section('content')
<div class="alert alert-warning">
	<h4>Login Required</h4>
	<p>로그인을 해야 접근할 수 있는 페이지 입니다! :(</p>
</div>
@stop

@section('footer_scripts')
@stop