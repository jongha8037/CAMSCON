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

.editor .save-controls {
	text-align: right;
}

.editor textarea {
	resize:vertical;
	min-height: 100px;
}

.editor .attachments {
	margin:20px 0px;
	border-top:1px solid #eee;
}

.editor .add-attachment-wrapper {
	text-align: center;
}

#attachmentUploadForm {
	display: none;
}
</style>
@stop

@section('content')
@foreach ($errors->all(':message') as $message)
<div class="alert alert-danger">
	<strong>오류!</strong> {{{$message}}}
</div>
@endforeach

@if(Session::has('proc_success'))
<div class="alert alert-success">
	@if(Session::get('proc_success')==='file_saved')
	<strong>처리 결과:</strong> 이미지가 저장되었습니다.
	@elseif(Session::get('proc_success')==='file_deleted')
	<strong>처리 결과:</strong> 이미지가 삭제되었습니다.
	@endif
</div>
@elseif(Session::has('proc_error'))
<div class="alert alert-danger">
	@if(Session::get('proc_error')==='db_error')
	<strong>처리 결과:</strong> 데이터베이스 에러가 발생했습니다.
	@elseif(Session::get('proc_error')==='file_proc')
	<strong>처리 결과:</strong> 파일처리에 실패했습니다.
	@elseif(Session::get('proc_error')==='no_file')
	<strong>처리 결과:</strong> 파일이 업로드되지 않았습니다.
	@endif
</div>
@endif

<div class="editor">
	<div class="entry-data">
	{{ Form::open(array( 'url'=>action('PictorialEditController@saveEntry'), 'method'=>'POST' )) }}
	<input type="hidden" name="entry_id" value="{{$pictorial->id}}" />

	<div class="form-group">
		<label for="entryTitle">제목</label>
		<input type="text" class="form-control" id="entryTitle" name="entry_title" placeholder="제목 (필수)" value="{{{$pictorial->title}}}" />
	</div>

	<div class="form-group">
		<label for="entryExcerpt">요약</label>
		<textarea class="form-control" id="entryExcerpt" name="entry_excerpt">{{{$pictorial->excerpt}}}</textarea>
	</div>

	<div class="form-group">
		<label for="entryContent">내용</label>
		<textarea class="form-control" id="entryContent" name="entry_content">{{{$pictorial->text}}}</textarea>
	</div>

	<div class="form-group save-controls">
		@if($pictorial->status==='published')
		<label class="radio-inline">
			<input type="radio" name="entry_status" value="published" checked="checked"> 공개
		</label>
		<label class="radio-inline">
			<input type="radio" name="entry_status" value="draft"> 비공개
		</label>
		@else
		<label class="radio-inline">
			<input type="radio" name="entry_status" value="published"> 공개
		</label>
		<label class="radio-inline">
			<input type="radio" name="entry_status" value="draft" checked="checked"> 비공개
		</label>
		@endif

		<button type="submit" class="btn btn-default btn-sm">저장</button>
		<a href="{{action('PictorialEditController@showList')}}" class="btn btn-default btn-sm">취소</a>
		<button type="button" id="deleteEntryBtn" class="btn btn-default btn-sm">삭제</button>
	</div>
	{{ Form::close() }}
	</div><!--/.post-data-->

	<div class="attachments">
		@foreach($pictorial->attachments as $attachment)
		<figure class="attachment-wrapper">
			<img src="{{$attachment->url}}" />
			<figcaption>
				<button type="button" class="btn btn-default deleteAttachmentBtn" data-id="{{$attachment->id}}">삭제</button>
			</figcaption>
		</figure>
		@endforeach
	</div><!--/.attachments-->

	<div class="add-attachment-wrapper">
		<button type="button" id="addAttachmentBtn" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-up"></span> 사진 추가하기</button>
	</div>
</div><!--/.editor-->

<!--DeleteForm-->
{{ Form::open(array( 'url'=>action('PictorialEditController@deleteEntry'), 'method'=>'POST', 'id'=>'entryDeleteForm' )) }}
<input type="hidden" name="entry_id" value="{{$pictorial->id}}" />
{{ Form::close() }}

<!--AttachmentUploadForm-->
{{ Form::open(array( 'url'=>action('PictorialEditController@uploadAttachment'), 'method'=>'POST', 'id'=>'attachmentUploadForm', 'files'=>true )) }}
<input type="hidden" name="entry_id" value="{{$pictorial->id}}" />
<input type="file" name="image" />
{{ Form::close() }}
@stop

@section('footer_scripts')
@include('includes.upload-modal')
<script type="text/javascript">
(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		var objx={
			deleteEntryBtn:$('#deleteEntryBtn'),
			entryDeleteForm:$('#entryDeleteForm'),
			addAttachmentBtn:$('#addAttachmentBtn'),
			uploadForm:$('#attachmentUploadForm')
		};

		module.init(objx);
	});
})(window, document, jQuery, {
	/*Pictorial Admin module*/
	objx:{
		deleteEntryBtn:null, 
		entryDeleteForm:null,
		addAttachmentBtn:null,
		uploadForm:null,
		attachmentField:null
	},
	init:function(objx) {
		this.objx=objx;
		this.objx.attachmentField=this.objx.uploadForm.find('input[type="file"]');

		this.objx.deleteEntryBtn.on('click', null, {deleteAction:this.deleteEntry.bind(this)}, function(e) {
			if(confirm('픽토리얼 항목을 삭제하시겠습니까?')) {
				e.data.deleteAction();
			}
		});

		this.objx.addAttachmentBtn.on('click', null, {fileSelector:this.showFileSelector.bind(this)}, function(e) {
			e.data.fileSelector();
		});

		this.objx.attachmentField.on('change', null, {uploadFile:this.uploadFile.bind(this)}, function(e) {
			e.data.uploadFile();
		});
	},
	deleteEntry:function() {
		this.objx.entryDeleteForm.submit();
	},
	showFileSelector:function() {
		this.objx.attachmentField.click();
	},
	uploadFile:function() {
		this.objx.uploadForm.submit();
	}
});
</script>
@stop