@extends('front.layouts.master')

@section('head_title')
Post
@stop

@section('head_styles')
<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/street-snap/editor.css')}}">
@stop

@section('content')
<div class="load-temp-section">
	<div class="dropdown">
		<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
		임시글 불러오기 <span class="caret"></span>
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			@foreach($drafts as $draft)
			<li><a href="{{action('StreetSnapEditor@showEditor', $draft->id)}}">#{{$draft->id}} {{$draft->pretty_title}} ({{$draft->created_at}})</a></li>
			@endforeach
		</ul>
	</div>
</div>

@if(Session::has('proc_result'))
	@if(Session::get('proc_result')=='success')
	<div class="post-proc-msg alert alert-success"><strong>성공!</strong> 포스트가 저장되었습니다.</div>
	@elseif(Session::get('proc_result')=='db_error')
	<div class="post-proc-msg alert alert-danger"><strong>오류!</strong> 데이터베이스 에러가 발생했습니다.</div>
	@elseif(Session::get('proc_result')=='primary_missing')
	<div class="post-proc-msg alert alert-danger"><strong>오류!</strong> 메인사진이 없는 포스트는 공개할 수 없습니다.</div>
	@endif
@endif

<div class="streetsnap-editor row">
	<div id="photoCol" class="photo-col col-xs-7">

		<div id="primaryPhotoEditor" class="primary-photo-editor">
			<h4 class="section-title">Main photo</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> Main photo는 당신이 올리는 데일리룩을 대표하는 사진입니다. 이 사진은 "핀 태깅"을 통해 아이템과 브랜드입력이 가능하며, 썸네일 및 대표이미지로 사용됩니다. 저희가 권장해 드리는 최적의 이미지는 가로폭이 <strong>670</strong>픽셀인 사진이며, 세로 높이에는 제한이 없습니다.
			</div>

			<figure class="primary-photo @if(empty($snap->primary)){{'dummy'}}@endif">
				<div class="pin-container"></div>
				@if($snap->primary)
					<img src="{{$snap->primary->url}}" width="{{$snap->primary->width}}" height="{{$snap->primary->height}}" />
				@endif
			</figure><!--/.primary-photo-->

			<div class="primary-toolbar">
				<button type="button" class="upload-btn btn btn-primary"><span class="glyphicon glyphicon-camera"></span> 사진 업로드</button>
				<button type="button" class="toggle-mode-btn btn btn-primary"><span class="glyphicon glyphicon-tag"></span> 핀으로 태깅하기</button>
				<span class="primary-toolbar-msg"></span>
			</div>
		</div><!--/#primaryPhotoEditor-->

		<div id="attachmentEditor" class="attachment-editor">
			<h4 class="section-title">Detail photos</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> 메인사진 이외의 디테일 및 아이템사진, 자신의 블로그 홍보이미지 등을 업로드할 수 있습니다. Main Photo와 마찬가지로 최적의 이미지는 가로폭을 <strong>670px</strong>픽셀로 맞춘 사진이며, 세로 높이에는 제약이 없습니다. 디테일사진은 "핀 태깅"이 불가능합니다.
			</div>

			<div class="attachment-list">
				@if(count($snap->attachments)>0)
				@foreach($snap->attachments as $img)
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
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> *Main photo 하단의 "핀으로 태깅하기" 버튼을 이용하여, 사진 속 아이템들의 브랜드와 구입처를 입력할 수 있습니다. "핀으로 태깅하기" 버튼 클릭 후, 입력하고자 하는 사진 속 아이템을 클릭해 보세요. 브랜드명은 영어로 입력해야하며, 브랜드입력 자동완성에 입력하고자 하는 브랜드가 없는 경우, 관리자에게 이메일을 통해 추가요청을 해주시면 감사하겠습니다. (devbot@camscon.kr)
			</div>

			<ol id="PinList" class="pin-data-container"></ol>
		</div><!--/.pin-section-->

		<div class="meta-section">
			<h4 class="section-title">Photo information</h4>

			<div class="alert alert-info">
				<strong><span class="glyphicon glyphicon-ok"></span> Tip!</strong> 사진 속 인물에 관한 정보를 입력하는 곳입니다. 학교나 거리와 같은 카테고리는 반드시 자동완성 기능을 이용하여 입력해야하며, 자동완성에 입력하고자 하는 항목이 없는 경우, 관리자에게 이메일(devbot@camscon.kr)을 통해 추가요청을 해주시면 감사하겠습니다. 자신의 패션블로그나 페이스북페이지를 홍보하고자 하는 분은, He/She says나 Inspirer's note를 활용해주시면 됩니다.
			</div>

			{{ Form::open(array('url'=>action('StreetSnapEditController@publishPost'), 'id'=>'streetSnapForm', 'class'=>'street-snap-form')) }}
				<input type="hidden" name="streetsnap_id" value="{{$snap->id}}" />

				<div class="form-group">
					<label>이름/별명/닉네임</label>
					<input type="text" class="form-control" name="name" value="@if(Input::old('name')){{Input::old('name')}}@else{{$snap->name or ''}}@endif" />
					@if($errors->has('name'))
					<p class="text-danger">이름은 필수 항목 입니다!</p>
					@endif
				</div>

				<div class="form-group">
					<label>나이(출생년도)</label>
					<input type="text" class="form-control" name="birth_year" placeholder="YYYY" value="@if(Input::old('birth_year')){{Input::old('birth_year')}}@else{{$snap->birthyear or ''}}@endif" />
					@if($errors->has('birth_year'))
						@if($errors->first('birth_year')=='date_format')
						<p class="text-danger">잘못된 형식 입니다!</p>
						@endif
					@endif
				</div>

				<div class="form-group">
					<label>카테고리 (학교/거리 등, 자동완성)</label>
					<input type="hidden" name="meta_type" value="@if(Input::old('meta_type')){{Input::old('meta_type')}}@else{{$snap->meta_type or ''}}@endif" />
					<input type="hidden" name="meta_id" value="@if(Input::old('meta_id')){{Input::old('meta_id')}}@else{{$snap->meta_id or ''}}@endif" />
					<input type="text" class="form-control" name="meta_category" placeholder="School, Street, Festival, Club, etc." value="@if(Input::old('meta_category')){{Input::old('meta_category')}}@elseif($snap->meta){{$snap->meta->name}}@endif" />
					@if($errors->has('meta_type') || $errors->has('meta_id'))
					<p class="text-danger">카테고리는 필수 항목 입니다! 자동완성기능을 이용하여 입력해주시기 바랍니다.</p>
					@endif
				</div>

				<div class="form-group">
					<label>학과 또는 직업</label>
					<input type="text" class="form-control" name="affiliation" value="@if(Input::old('affiliation')){{Input::old('affiliation')}}@else{{$snap->affiliation or ''}}@endif" />
				</div>

				<div class="form-group">
					<label>성별</label>
					<div class="row block-radio">
						<div class="col-xs-6">
							<input type="radio" id="genderRadioFemale" name="gender" value="female" @if(Input::old('gender')=='female' || $snap->gender=='female'){{'checked="checked"'}}@endif />
							<label for="genderRadioFemale">여자</label>
						</div>
						<div class="col-xs-6">
							<input type="radio" id="genderRadioMale" name="gender" value="male" @if(Input::old('gender')=='male' || $snap->gender=='male'){{'checked="checked"'}}@endif />
							<label for="genderRadioMale">남자</label>
						</div>
					</div>
					@if($errors->has('gender'))
						@if($errors->first('gender')=='required')
						<p class="text-danger">성별은 필수 항목 입니다!</p>
						@endif
					@endif
				</div>

				<div class="form-group">
					<label>He/She says:</label>
					<textarea class="form-control comment-textbox" name="subject_comment">@if(Input::old('subject_comment')){{Input::old('subject_comment')}}@else{{$snap->subject_comment or ''}}@endif</textarea>
				</div>

				<div class="form-group">
					<label>Inspirer's note:</label>
					<textarea class="form-control comment-textbox" name="photographer_comment">@if(Input::old('photographer_comment')){{Input::old('photographer_comment')}}@else{{$snap->photographer_comment or ''}}@endif</textarea>
				</div>

				<div class="form-group">
					<label>계절</label>
					<div class="row block-radio">
						<div class="col-xs-6">
							<input type="radio" id="seasonRadioSS" name="season" value="S/S" @if(Input::old('season')=='S/S' || $snap->season=='S/S'){{'checked="checked"'}}@endif />
							<label for="seasonRadioSS">S/S</label>
						</div>
						<div class="col-xs-6">
							<input type="radio" id="seasonRadioFW" name="season" value="F/W" @if(Input::old('season')=='F/W' || $snap->season=='F/W'){{'checked="checked"'}}@endif />
							<label for="seasonRadioFW">F/W</label>
						</div>
					</div>
					@if($errors->has('season'))
						@if($errors->first('season')=='required')
						<p class="text-danger">계절은 필수 항목 입니다!</p>
						@endif
					@endif
				</div>
			{{Form::close()}}

			{{ Form::open(array('url'=>action('StreetSnapEditController@deletePost'), 'id'=>'snapDeleteForm')) }}
				<input type="hidden" name="id" value="{{$snap->id}}" />
			{{ Form::close() }}

			<div class="post-controls">
				@if($errors->first('streetsnap_id')=='exists')
				<p class="text-danger">존재하지 않거나 편집 권한이 없는 포스트 입니다!</p>
				@elseif($errors->first('meta_type')=='in' || $errors->first('meta_id')=='meta_exists' || $errors->first('gender')=='in' || $errors->first('season')=='in')
				<p class="text-danger">잘못된 요청입니다!</p>
				@endif

				<span class="post-control-msg"></span>
				<button type="button" class="delete-btn btn btn-danger">삭제</button>
				<button type="submit" class="publish-btn btn btn-primary">공개하기</button>
			</div><!--/.content-controls-->
		</div><!--/.meta-section-->

		
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
						<input type="text" class="form-control" name="link" placeholder="http:// or https:// 포함 링크 주소 (옵션)" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="cancel-btn btn btn-default">취소</button>
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
	snap:{
		id:"{{$snap->id}}",
		status:"{{$snap->status}}"
	},
	endpoints:{
		uploadPrimary:"{{action('StreetSnapEditController@uploadPrimary')}}",
		uploadAttachment:"{{action('StreetSnapEditController@uploadAttachment')}}",
		deleteAttachment:"{{action('StreetSnapEditController@deleteAttachment')}}",
		brandsData:"{{action('BrandsController@jsonList', null)}}",
		savePin:"{{action('StreetSnapEditController@savePin')}}",
		deletePin:"{{action('StreetSnapEditController@deletePin')}}",
		metaData:"{{action('StreetSnapEditController@getMetaJson')}}"
	},
	token:"{{csrf_token()}}",
	pins:@if($snap->pins->count()){{$snap->pins->toJson()}}@else{{'[]'}}@endif
};//EditorData{}
</script>

<script type="text/javascript" src="{{asset('admin-assets/street-snap/editor.js')}}"></script>
@stop