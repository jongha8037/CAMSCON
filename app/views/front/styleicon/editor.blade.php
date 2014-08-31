@extends('front.layouts.master')

@section('head_title')
Post
@stop

@section('head_styles')
<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/style-icon/editor.css')}}">
@stop

@section('content')
<div class="icon-editor row">
	<div id="photoCol" class="photo-col col-xs-7">

		<div id="primaryPhotoEditor" class="primary-photo-editor">
			<h4 class="section-title">Primary photo</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> Primary Photo는 스타일 아이콘을 대표하는 사진입니다. 이 사진은 핀 태깅이 가능하며, 썸네일 및 대표 이미지로 사용됩니다. 최적의 이미지 크기는 가로 폭을 <strong>670px</strong>으로 맞춘 것이며, 세로 높이에는 제약이 없습니다.
			</div>

			<figure class="primary-photo @if(empty($icon->primary)){{'dummy'}}@endif">
				<div class="pin-container"></div>
				@if($icon->primary)
					<img src="{{$icon->primary->url}}" width="{{$icon->primary->width}}" height="{{$icon->primary->height}}" />
				@endif
			</figure><!--/.primary-photo-->

			<div class="primary-toolbar">
				<button type="button" class="upload-btn btn btn-primary"><span class="glyphicon glyphicon-camera"></span> 사진 업로드</button>
				<button type="button" class="toggle-mode-btn btn btn-primary"><span class="glyphicon glyphicon-tag"></span> 핀으로 태깅하기</button>
				<span class="primary-toolbar-msg"></span>
			</div>
		</div><!--/#primaryPhotoEditor-->

		<div id="attachmentEditor" class="attachment-editor">
			<h4 class="section-title">Attachments</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> 여기에는 스타일 아이콘의 다른 사진들을 업로드 할 수 있습니다. Primary Photo와 마찬가지로 최적의 이미지 크기는 가로 폭을 <strong>670px</strong>으로 맞춘 것이며, 세로 높이에는 제약이 없습니다.
			</div>

			<div class="attachment-list">
				@if(count($icon->attachments)>0)
				@foreach($icon->attachments as $img)
				<figure data-id="{{$img->id}}">
					<button class="delete-btn btn btn-warning" data-id="{{$img->id}}">삭제</button>
					<img src="{{$img->url}}" width="{{$img->width}}" height="{{$img->height}}" />
				</figure>
				@endforeach
				@else
				<figure class="dummy"></figure>
				@endif
			</div><!--/.attachment-list-->

			<div class="attachment-toolbar">
				<button type button class="upload-btn btn btn-primary"><span class="glyphicon glyphicon-camera"></span> 사진 업로드</button>
				<span class="attachment-toolbar-msg"></span>
			</div><!--/.attachment-toolbar-->
		</div><!--/#attachmentsEditor-->

	</div><!--/#photoCol-->

	<div id="dataCol" class="data-col col-sm-5">
		<div class="pin-section">
			<h4 class="section-title">Pin tags</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> Primary Photo 하단의 <strong>핀으로 태깅하기</strong> 버튼을 이용하여 태깅 모드에서 새로운 핀을 생성할 수 있습니다. 브랜드 입력은 영어로 해야 하며, 자동완성에 입력하고자 하는 브랜드가 없는 경우 관리자에게 추가 요청을 하시기 바랍니다.
			</div>

			<ol id="PinList" class="pin-data-container"></ol>
		</div><!--/.pin-section-->




		<h4 class="section-title">스타일 아이콘 정보</h4>
		<div class="form-group">
			<label>이름</label>
			<input type="text" class="form-control" />
		</div>

		<div class="form-group">
			<label>나이</label>
			<input type="text" class="form-control" />
		</div>

		<div class="form-group">
			<label>학교/거리</label>
			<input type="text" class="form-control" placeholder="(자동완성)" />
		</div>

		<div class="form-group">
			<label>학과/직업</label>
			<input type="text" class="form-control" />
		</div>

		<div class="form-group">
			<label>성별</label>
			<div>
			<label style="margin-right:10px;">
				<input type="radio" name="gender" style="vertical-align:text-bottom;" /> 여자 사람
			</label>
			<label>
				<input type="radio" name="gender" style="vertical-align:text-bottom;" /> 남자 사람
			</label>
			</div>
		</div>

		<div class="form-group">
			<label>Style Icon comment</label>
			<textarea class="form-control"></textarea>
		</div>

		<div class="form-group">
			<label>Photographer's note</label>
			<textarea class="form-control"></textarea>
		</div>

	</div><!--/#dataCol-->
</div><!--/.icon-editor-container row-->

<!--PinEdit Modal-->
<div id="PinEditModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">핀 편집</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<input type="text" class="form-control" name="brand" placeholder="브랜드 (영문)" />
					</div>
					<div class="col-xs-12 col-sm-6">
						<select class="form-control" name="item">
							@foreach($itemCategories as $category)
							<optgroup label="{{{$category->model->name}}}">
								@foreach($category->children as $child)
								<option value="{{$child->id}}">{{{$child->name}}}</option>
								@endforeach
							</optgroup>
							@endforeach
						</select>
					</div>
					<div class="col-xs-12">
						<input type="text" class="form-control" name="link" placeholder="링크 (옵션)" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="confirm-btn btn btn-primary">확인</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/PinEdit Modal-->
@stop

@section('footer_scripts')
@include('includes.upload-modal')
<!--jQuery UI-->
<script src="{{asset('packages/jquery-ui-1.11.0-hot-sneaks-full/jquery-ui.min.js')}}"></script>

<script type="text/javascript" src="{{asset('packages/typeahead.js/typeahead.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('packages/typeahead.js/typeahead.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('packages/typeahead.js/bloodhound.min.js')}}"></script>

<script type="text/javascript">
var EditorData={
	icon:{
		id:"{{$icon->id}}",
		status:"{{$icon->status}}"
	},
	endpoints:{
		uploadPrimary:"{{action('StyleIconController@uploadPrimary')}}",
		uploadAttachment:"{{action('StyleIconController@uploadAttachment')}}",
		deleteAttachment:"{{action('StyleIconController@deleteAttachment')}}",
		brandsData:"{{action('BrandsController@jsonList', null)}}"
	},
	token:"{{csrf_token()}}",
	pins:[]
};//EditorData{}
</script>

<script type="text/javascript" src="{{asset('admin-assets/style-icon/editor.js')}}"></script>
@stop