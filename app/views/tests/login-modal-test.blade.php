@extends('front.layouts.master')

@section('head_title')
Master Layout Test
@stop

@section('head_styles')
<style type="text/css">
.login-with-fb-wrapper, 
.signup-with-fb-wrapper {
	padding-bottom: 10px;
	border-bottom: 1px solid #ddd;
	margin-bottom: 10px;
}

#LoginModal .btn {
	display:block;
	width:100%;
}
</style>
@stop

@section('content')
<h1>Login Modal Test</h1>
@stop

@section('footer_scripts')
<script type="text/javascript"></script>
@stop