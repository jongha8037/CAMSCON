@extends('admin.layouts.admin-master')

@section('head_title')
Admin Pictorials - CAMSCON
@stop

@section('head_styles')
<style type="text/css">
.pictorial-admin {
	max-width:800px;
	margin:50px auto;
}

.pictorial-admin .pictorial-list {
	list-style-type: none;
	padding:0px;
}

.pictorial-admin .pictorial-list li {
	border-bottom:1px solid #eee;
}

.pictorial-admin .pictorial-list li h3 {
	font-size:20px;
}

.pictorial-admin .pictorial-list li h3 .label {

}
</style>
@stop

@section('content')
@if(Session::has('proc_success'))
<div class="alert alert-success">
	@if(Session::get('proc_success')==='saved')
	<strong>처리 결과:</strong> 저장되었습니다.
	@elseif(Session::get('proc_success')==='deleted')
	<strong>처리 결과:</strong> 삭제되었습니다.
	@endif
</div>
@elseif(Session::has('proc_error'))
<div class="alert alert-danger">
	@if(Session::get('proc_error')==='db_error')
	<strong>처리 결과:</strong> 데이터베이스 에러가 발생했습니다.
	@endif
</div>
@endif

<div class="pictorial-admin">
	<h1>픽토리얼 관리 <a href="{{action('PictorialEditController@showEditor', null)}}" class="btn btn-primary btn-xs">새 픽토리얼 추가하기</a></h1>

	<ul class="pictorial-list">
		@foreach($pictorials as $pictorial)
		<li class="pictorial">
			@if($pictorial->status==='published')
			<h3><a href="{{action('PictorialEditController@showEditor', $pictorial->id)}}">{{{$pictorial->title}}}</a></h3>
			@else
			<h3><a href="{{action('PictorialEditController@showEditor', $pictorial->id)}}">{{{$pictorial->title}}}</a></h3>
			@endif
			<div class="byline">
				@if($pictorial->status==='published')
				<span class="label label-success">공개</span>
				@else
				<span class="label label-default">비공개</span>
				@endif
				Last update by
				<span class="author">{{{$pictorial->user->nickname}}}</span>
				at
				<span class="date">{{$pictorial->updated_at}}</span>
			</div>
			<p>{{{$pictorial->excerpt}}}</p>
		</li>
		@endforeach
	</ul>
</div>
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