@extends('admin.layouts.admin-master')

@section('head_title')
Pictorial Editor - CAMSCON
@stop

@section('head_styles')
<style type="text/css">
.editor {
	max-width: 800px;
	margin:60px auto;
}

.editor .post-data {
	border-bottom:1px solid #eee;
}

.editor .attachments {}
</style>
@stop

@section('content')
@if(Session::has('affectedRows'))
<div class="alert alert-info">
	<strong>처리 결과:</strong> {{Session::get('affectedRows')}}건 변경됨.
</div>
@endif

<div class="editor">
	<div class="post-data">
	{{ Form::open(array()) }}
	<div class="form-group">
		<label for="postTitle">제목</label>
		<input type="text" class="form-control" id="postTitle" name="post_title" placeholder="제목 (필수)" />
	</div>

	<div class="form-group">
		<label for="postThumbnail">대표 이미지</label>
		<input type="file" class="form-control" id="postThumbnail" name="post_thumbnail" />
	</div>

	<div class="form-group">
		<label for="postExcerpt">요약</label>
		<textarea class="form-control" id="postExcerpt" name="post_excerpt"></textarea>
	</div>

	<div class="btn-toolbar" role="toolbar">
		<div class="btn-group" role="group">...</div>
		<div class="btn-group" role="group">...</div>
	</div>
	{{ Form::close() }}
	</div><!--/.post-data-->

	<div class="attachments"></div><!--/.attachments-->
</div><!--/.editor-->
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