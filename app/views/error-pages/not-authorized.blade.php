@extends('front.layouts.master')

@section('head_title')
CAMSCON - 권한 없음
@stop

@section('content')
<div class="alert alert-warning">
	<h4>401: Unauthorized</h4>
	<p>페이지 접근 권한이 없습니다! :( 다른 계정으로 로그인 하거나 관리자에게 문의해 주시기 바랍니다.</p>
</div>
@stop

@section('footer_scripts')
@stop