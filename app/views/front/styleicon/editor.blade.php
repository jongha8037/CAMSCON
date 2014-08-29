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
			<h4>Primary photo</h4>

			<figure class="primary-photo empty">
				<div class="pins"></div>
			</figure><!--/.primary-photo-->

			<div class="primary-toolbar">
				<button type="button" class="upload-btn btn btn-primary"><span class="glyphicon glyphicon-camera"></span> Upload</button>
				<button type="button" class="toggle-mode-btn btn btn-primary"><span class="glyphicon glyphicon-tag"></span> Pin</button>
				<span class="primary-toolbar-msg"></span>
			</div>
		</div><!--/#primaryPhotoEditor-->

		<hr />

		<div id="attachmentEditor" class="attachment-editor">
			<h4>Attachments</h4>

			<div class="attachment-list"></div><!--/.attachment-list-->

			<div class="attachment-toolbar">
				<button type button class="upload-btn btn btn-primary"><span class="glyphicon glyphicon-camera"></span> Upload</button>
			</div><!--/.attachment-toolbar-->
		</div><!--/#attachmentsEditor-->

	</div><!--/#photoCol-->
	<div id="dataCol" class="data-col col-sm-5">
		<h4>스타일 아이콘 정보</h4>
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

		<h4>Pins</h4>
		<ol id="pinData" class="pin-data-container"></ol>

	</div>
</div><!--/.icon-editor-container row-->

@stop

@section('footer_scripts')
@include('includes.upload-modal')
<script type="text/javascript" src="{{asset('packages/typeahead.js/typeahead.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('packages/typeahead.js/typeahead.jquery.min.js')}}"></script>

<script type="text/javascript">
var EditorData={
	icon:{
		id:"{{$icon->id}}",
		status:"{{$icon->status}}"
	},
	endpoints:{
		uploadPrimary:"{{action('StyleIconController@uploadPrimary')}}",
		uploadAttachment:"{{action('StyleIconController@uploadAttachment')}}"
	},
	pins:[],
	pin_total:0
};//EditorData{}


var PrimaryEditor={
	jqo:null,
	figure:null,
	pins:null,
	uploadBtn:null,
	toggleBtn:null,
	pinContainer:null,
	pin_mode:false,
	photo:{
		id:null,
		url:null,
		width:null,
		height:null
	}/*photo{}*/,
	init:function() {
		this.jqo=$('#primaryPhotoEditor');
		this.figure=this.jqo.find('figure.primary-photo');
		this.pins=this.figure.find('div.pins');
		this.uploadBtn=this.jqo.find('button.upload-btn');
		this.toggleBtn=this.jqo.find('button.toggle-mode-btn');
		this.pinContainer=$('#pinData');

		this.uploadBtn.on('click', null, null, function() {
			UploadModal.launch(null, function(file) {
				if(file instanceof File) {
					PrimaryEditor.upload(file);
				}
			}, null);
		});

		this.toggleBtn.on('click', null, null, function() {
			if(PrimaryEditor.pin_mode===false) {
				PrimaryEditor.pin_mode=true;
				$(this).html('<span class="glyphicon glyphicon-tag"></span> Done');
			} else {
				PrimaryEditor.pin_mode=false;
				$(this).html('<span class="glyphicon glyphicon-tag"></span> Pin');
			}
		});

		this.figure.on('click', 'img', null, function(e) {
			if(PrimaryEditor.pin_mode===true) {
				var img=PrimaryEditor.figure;
				PrimaryEditor.addPin(e.pageX-img.offset().left,e.pageY-img.offset().top);
			}
		});
	}/*init()*/,
	upload:function(file) {
		var formData=new FormData();
		formData.append('image', file);
		formData.append('id', EditorData.icon.id);
		$.ajax({
			url: EditorData.endpoints.uploadPrimary,
			type: "POST",
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			dataType:'json',
			success:function(response) {
				console.log(response);
				if(response.type=='success') {
					PrimaryEditor.photo=response.data;
					PrimaryEditor.setPhoto();
				}
			},
			error:function() {
				//
			}
		});
	}/*upload()*/,
	setPhoto:function() {
		var img=this.resolveUrl(this.photo);
		this.figure.find('img').remove();
		this.figure.append(img);
		this.figure.removeClass('empty');

	},
	resolveUrl:function(data) {
		var img=$('<img />');
		img.prop('src', data.url);
		img.prop('width', data.width);
		img.prop('height', data.height);
		return img;
	},
	/*Temp Code*/
	addPin:function(x,y) {
		//Check max pin restraint
		if(EditorData.pins.length>=9) {
			console.log('Max pins');
		} else {
			EditorData.pin_total++;
			var newPin=$('<div class="pin">'+EditorData.pin_total+'</div>');
			newPin.css({
				left:x,
				top:y
			});
			PrimaryEditor.pins.append(newPin);

			var newPinData=$('<li class="pin-data"><div class="row"><div class="col-xs-6"><input type="text" placeholder="브랜드 (자동완성)" class="form-control" /></div><div class="col-xs-6"><select class="form-control"><option>아이템</option></select></div><div class="col-xs-12"><input type="text" class="form-control" placeholder="http://" style="margin-top:5px;" /></div></div></li>');
			PrimaryEditor.pinContainer.append(newPinData);

			//Create new pin object
			/*
			var newPin=new PinClass($('<div class="pin"></div>'),x,y);
			PinData.push(newPin);
			*/

			//Render in image container (Edit mode)
			//this.pinContainer.object.append(newPin.object);
			//this.renderPinsEdit();

			//Add pin edit controlls

		}
	}
};//PrimaryEditor{}

var AttachmentEditor={
	jqo:null,
	list:null,
	uploadBtn:null,
	toggleBtn:null,
	photo:{
		id:null,
		url:null,
		width:null,
		height:null
	}/*photo{}*/,
	init:function() {
		this.jqo=$('#attachmentEditor');
		this.list=this.jqo.find('div.attachment-list');
		this.uploadBtn=this.jqo.find('button.upload-btn');

		this.uploadBtn.on('click', null, null, function() {
			UploadModal.launch(null, function(file) {console.log('asdf');
				if(file instanceof File) {
					AttachmentEditor.upload(file);
				}
			}, null);
		});
	}/*init()*/,
	upload:function(file) {
		var formData=new FormData();
		formData.append('image', file);
		formData.append('id', EditorData.icon.id);
		$.ajax({
			url: EditorData.endpoints.uploadPrimary,
			type: "POST",
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			dataType:'json',
			success:function(response) {
				console.log(response);
				if(response.type=='success') {
					AttachmentEditor.photo=response.data;
					AttachmentEditor.setPhoto();
				}
			},
			error:function() {
				//
			}
		});
	}/*upload()*/,
	setPhoto:function() {
		var img=this.resolveUrl(this.photo);
		this.list.append(img);

	},
	resolveUrl:function(data) {
		var img=$('<img />');
		img.prop('src', data.url);
		img.prop('width', data.width);
		img.prop('height', data.height);
		var figure=$('<figure></figure');
		figure.append(img);
		return figure;
	}
};//AttachmentEditor{}

$(document).ready(function() {
	PrimaryEditor.init();
	AttachmentEditor.init();
});//document.ready()
</script>
@stop