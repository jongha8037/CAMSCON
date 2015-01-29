@extends('admin.layouts.admin-master')

@section('head_title')
Admin Pictorials - CAMSCON
@stop

@section('head_styles')
<style type="text/css">
</style>
@stop

@section('content')
@if(Session::has('affectedRows'))
<div class="alert alert-info">
	<strong>처리 결과:</strong> {{Session::get('affectedRows')}}건 변경됨.
</div>
@endif

<h1>픽토리얼 관리 <a href="{{action('PictorialEditController@showEditor', null)}}" class="btn btn-primary btn-xs">새 픽토리얼 추가하기</a></h1>

<ul class="pictorial-list">
	@foreach($pictorials as $pictorial)
	<li class="pictorial">
		@if($pictorial->post->status==='published')
		<h3>{{{$pictorial->post->title}}} <span class="status published">공개</span></h3>
		@else
		<h3>{{{$pictorial->post->title}}} <span class="status draft">비공개</span></h3>
		@endif
		<div class="byline">
			Last update by
			<span class="author">{{{$pictorial->post->user->nickname}}}</span>
			at
			<span class="date">{{$pictorial->post->updated_at}}</span>
		</div>
		<p>{{{$pictorial->post->excerpt}}}</p>
	</li>
	@endforeach
</ul>
@stop

@section('footer_scripts')
<script type="text/javascript">
(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		//
	});
})(window, document, jQuery, {
	/*Pictorial Admin module*/
	objx:{
		actionForm:null,
		actionFormInput:null,
		actionList:null,
		formTable:null,
		toggleCheckedBtn:null
	},
	init:function() {}
});
</script>
@stop