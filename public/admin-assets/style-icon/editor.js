function PinEngine() {
	this.max_pins=9;
	this.pins=[];

	this.init=function(container, list) {
		this.container=container;
		this.img=container.siblings('img');
		this.pinContainer=container.find('pin-container');
		this.list=list;
	};

	this.addPin=function(x, y) {
		if(this.pins.length<this.max_pins) {
			var newPin=new PinObject(x, y);
			var pinsLength=this.pins.push(newPin);
			this.renderPins();
			PinEditor.launch(newPin, function(data) {
				if(data.brand) {
					newPin.brand=data.brand;
				}
				newPin.item=data.item;
				newPin.link=data.link;
				PrimaryEditor.pinEngine.renderPins();
				PrimaryEditor.pinEngine.savePin(newPin);
			});
		}
	};

	this.renderPins=function() {
		this.container.empty();
		this.list.empty();
		var l=this.pins.length;
		for(var i=0;i<l;i++) {
			this.pins[i].indexNo=i;
			this.pins[i].displayNo=i+1;
			scale=this.img.outerWidth()/this.img.attr('width');
			this.pins[i].tag(i,this.img.position().top,this.img.position().left,scale).appendTo(this.container);
			this.pins[i].listItem(i).appendTo(this.list);
		}
	};

	this.savePin=function(pin) {
		console.log(pin);
	};

	this.deletePin=function(pin) {
		console.log(pin);
	};
};//PinEngine

function PinObject(x, y) {
	this.id=0;
	this.item={
		item_id:0,
		item_name:'아이템 미지정'
	};
	this.brand={
		brand_id:0,
		brand_name:'브랜드 미지정'
	};
	this.x=x;
	this.y=y;
	
	//Tag jquery object
	this.tagObj=$('<div class="pin"></div>');
	this.tag=function(indexNo,offsetTop,offsetLeft,scale) {
		this.tagObj.attr('data-index', indexNo)
			.css({
				top:(this.y+offsetTop)*scale,
				left:(this.x+offsetLeft)*scale
			})
			.text(indexNo+1);
		return this.tagObj;
	};

	//List item jquery object
	this.listItemObj=$('<li class="pin"><span class="pin-item"></span> by <span class="pin-brand"></span><a class="pin-link" href=""></a><div class="pin-controls"><a href="" class="pin-edit">수정</a> <a href="" class="pin-delete">삭제</a></div></li>');
	this.listItem=function(indexNo) {
		this.listItemObj.attr('data-index', indexNo);
		this.listItemObj.find('span.pin-item').text(this.item.item_name);
		this.listItemObj.find('span.pin-brand').text(this.brand.brand_name);
		this.listItemObj.find('a.pin-link').attr('href', this.link).text(this.link);

		this.listItemObj.on('click', 'a.pin-edit', {pin:this}, function(e) {
			e.preventDefault();
			var pinObj=e.data.pin;
			PinEditor.launch(pinObj, function(data) {
				if(data.brand) {
					pinObj.brand=data.brand;
				}
				pinObj.item=data.item;
				pinObj.link=data.link;

				PrimaryEditor.pinEngine.savePin(pinObj);
				PrimaryEditor.pinEngine.renderPins();
			});
		});
		this.listItemObj.on('click', 'a.pin-delete', {pin:this}, function(e) {
			e.preventDefault();
			PrimaryEditor.pinEngine.deletePin(e.data.pin);
		});

		return this.listItemObj;
	};
};//PinObject

var PinEditor={
	jqo:null,
	pin:null,
	callback:null,
	data:{
		brand:{
			brand_id:null,
			brand_name:null
		},
		item:{
			item_id:null,
			item_name:null
		},
		link:null
	},
	init:function(selector) {
		this.jqo=$(selector);
		this.jqo.modal({show:false});

		// constructs the suggestion engine
		var brands = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			limit: 15,
			remote:EditorData.endpoints.brandsData+'/%QUERY'
		});
		 
		// kicks off the loading/processing of `local` and `prefetch`
		brands.initialize();
		 
		this.jqo.find('input[name="brand"]').typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: 'brands',
			displayKey: 'name_en',
			// `ttAdapter` wraps the suggestion engine in an adapter that
			// is compatible with the typeahead jQuery plugin
			source: brands.ttAdapter(),
		}).bind('typeahead:selected', function(e,suggestion,dataset) {
			PinEditor.data.brand.brand_id=suggestion.id;
			PinEditor.data.brand.brand_name=suggestion.name_en;
		});

		this.jqo.on('click','.confirm-btn',{editor:this},function(e) {
			var editor=e.data.editor;

			var itemSelector=editor.jqo.find('select[name="item"]');
			editor.data.item={
				item_id:itemSelector.val(),
				item_name:itemSelector.find('option[value="'+itemSelector.val()+'"]').text()
			};

			editor.data.link=editor.jqo.find('input[name="link"]').val();

			if(typeof editor.callback==='function') {
				editor.callback.apply(null,[editor.data]);
			}
			editor.jqo.modal('hide');
		});
	}/*init()*/,
	launch:function(pin,callback) {
		//Setup callback
		this.pin=pin;
		this.callback=callback;

		//Clear data
		this.data.brand={brand_id:null,brand_name:null};
		this.data.item={item_id:null,item_name:null};
		this.data.link=null;

		//Clear fields
		this.jqo.find('input[name="brand"]').typeahead('val', '');
		this.jqo.find('input[name="item"]').val(null);

		//Launch modal
		this.jqo.modal('show');
	}/*launch()*/
};//PinEditor{}

var PrimaryEditor={
	jqo:null,
	objects:{
		imageContainer:null,
		imageMsg:null,
		pinContainer:null,
		pinList:null,
		uploadBtn:null,
		toggleBtn:null
	},
	pin_mode:false,
	photo:{
		id:null,
		url:null,
		width:null,
		height:null
	}/*photo{}*/,
	pinEngine:null,
	pinEditor:null,
	init:function() {
		this.jqo=$('#primaryPhotoEditor');
		this.objects.imageContainer=this.jqo.find('figure.primary-photo');
		this.objects.imageMsg=this.jqo.find('.primary-toolbar-msg');
		this.objects.pinContainer=this.objects.imageContainer.find('div.pin-container');
		this.objects.pinList=$('#PinList');
		this.objects.uploadBtn=this.jqo.find('button.upload-btn');
		this.objects.toggleBtn=this.jqo.find('button.toggle-mode-btn');

		//Init Pin Engine
		this.pinEngine=new PinEngine();
		this.pinEngine.init(this.objects.pinContainer, this.objects.pinList);

		this.objects.uploadBtn.on('click', null, null, function() {
			UploadModal.launch(null, function(file) {
				if(file instanceof File) {
					PrimaryEditor.upload(file);
				}
			}, null);
		});

		this.objects.toggleBtn.on('click', null, null, function() {
			if(!PrimaryEditor.objects.imageContainer.hasClass('dummy')) {
				if(PrimaryEditor.pin_mode===false) {
					PrimaryEditor.objects.uploadBtn.prop('disabled', true);
					PrimaryEditor.pinMode('on');
					$(this).html('<span class="glyphicon glyphicon-tag"></span> 태깅 완료');
				} else {
					PrimaryEditor.objects.uploadBtn.prop('disabled', false);
					PrimaryEditor.pinMode('off');
					$(this).html('<span class="glyphicon glyphicon-tag"></span> 핀으로 태깅하기');
				}
			}
		});

		this.objects.imageContainer.on('click', 'img', null, function(e) {
			if(PrimaryEditor.pin_mode===true) {
				var img=$(this);
				PrimaryEditor.pinEngine.addPin(e.pageX-img.offset().left,e.pageY-img.offset().top);
			}
		});
	}/*init()*/,
	pinMode:function(action) {
		var container=this.objects.imageContainer;
		if(action=='on') {
			this.pin_mode=true;
			var containerCSS={width:0,height:0};
			containerCSS.width=container.innerWidth();
			containerCSS.height=container.innerHeight();
			containerCSS.display='block';
			container.css(containerCSS);
			container.addClass('pinning');

			container.find('img').draggable({
				start:function(e,ui) {
					container.addClass('moving');
					//PinEngine.hidePins();
				},
				stop:function(e,ui) {
					container.removeClass('moving');

					var fixedPos={};
					if(ui.position.top>0) {
						fixedPos.top=0;
					}
					if(ui.position.left>0) {
						fixedPos.left=0;
					}

					var imgSize={
						width:$(this).outerWidth(),
						height:$(this).outerHeight()
					};

					var containerSize={
						width:container.innerWidth(),
						height:container.innerHeight()
					}

					if(ui.position.left+imgSize.width<containerSize.width) {
						fixedPos.left=containerSize.width-imgSize.width;
					}
					if(ui.position.top+imgSize.height<containerSize.height) {
						fixedPos.top=containerSize.height-imgSize.height;
					}

					ui.helper.animate(fixedPos,200,function() {
						img=container.find('img');
						img.offset=ui.helper.offset();
						img.pos=ui.helper.position();
						PrimaryEditor.pinEngine.renderPins();
					});
				}
			});
		} else {
			this.pin_mode=false;
			container.removeAttr('style').removeClass('pinning');
			container.find('img').removeAttr('style').draggable('destroy');
		}

		this.pinEngine.renderPins();
	},
	upload:function(file) {
		//Disable controls
		this.objects.uploadBtn.prop('disabled', true);
		this.objects.toggleBtn.prop('disabled', true);
		this.setMsg('업로드 중 입니다...', 'info');

		var formData=new FormData();
		formData.append('image', file);
		formData.append('_token', EditorData.token);
		formData.append('styleicon_id', EditorData.icon.id);
		$.ajax({
			url: EditorData.endpoints.uploadPrimary,
			type: "POST",
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			dataType:'json',
			success:function(response) {
				console.log(response);
				if(typeof response==='object' && 'type' in response && 'data' in response) {
					if(response.type=='success') {
						PrimaryEditor.photo=response.data;
						PrimaryEditor.setPhoto(response.data);
						PrimaryEditor.clearMsg();
					} else if(response.type=='error') {
						switch(response.data) {
							case 'file_proc':
							PrimaryEditor.setMsg('파일 처리 실패!', 'danger');
							break;
							case'no_file':
							PrimaryEditor.setMsg('정상적인 업로드가 이루어지지 않았습니다!', 'danger');
							break;
							case 'not_found':
							PrimaryEditor.setMsg('존재하지 않는 스타일 아이콘 입니다!', 'danger');
							break;
							case 'not_owner':
							PrimaryEditor.setMsg('편집 권한이 없습니다!', 'danger');
							break;
							default:
							PrimaryEditor.setMsg('알 수 없는 오류가 발생했습니다!', 'danger');
						}
					}
				} else {
					PrimaryEditor.setMsg('정상적인 서버 응답을 받지 못했습니다!', 'danger');
				}
			},
			error:function() {
				PrimaryEditor.setMsg('현재 서버와 통신이 불가능 합니다!', 'danger');
			},
			complete:function() {
				//Enable controls
				PrimaryEditor.objects.uploadBtn.prop('disabled', false);
				PrimaryEditor.objects.toggleBtn.prop('disabled', false);
			}
		});
	}/*upload()*/,
	setPhoto:function(img) {
		var primary=$('<img src="" />').prop('src', img.url).prop('width', img.width).prop('height', img.height);
		this.objects.imageContainer.find('img').remove();
		this.objects.imageContainer.append(primary);
		this.objects.imageContainer.removeClass('dummy');

	}/*setPhoto*/,
	setMsg:function(msg,type) {
		var helperclass=null;
		switch(type) {
			case 'info':
				helperclass='text-info';
				break;
			case 'danger':
				helperclass='text-danger';
				break;
			case 'danger':
				helperclass='text-danger';
				break;
			case 'success':
				helperclass='text-success';
				break;
			default:
				helperclass='text-muted'
		}
		this.objects.imageMsg.html(msg).addClass(helperclass);
	}/*setMsg()*/,
	clearMsg:function() {
		this.objects.imageMsg.html(null).removeClass();
	}/*clearMsg*/
};//PrimaryEditor{}

var AttachmentEditor={
	jqo:null,
	objects:{
		list:null,
		uploadBtn:null,
		toolbarMsg:null
	},
	init:function() {
		this.jqo=$('#attachmentEditor');
		this.objects.list=this.jqo.find('div.attachment-list');
		this.objects.uploadBtn=this.jqo.find('button.upload-btn');
		this.objects.toolbarMsg=this.jqo.find('.attachment-toolbar-msg');

		this.objects.uploadBtn.on('click', null, null, function() {
			UploadModal.launch(null, function(file) {
				if(file instanceof File) {
					AttachmentEditor.upload(file);
				}
			}, null);
		});

		this.objects.list.find('figure').on('click', '.delete-btn', null, function() {
			AttachmentEditor.delete($(this));
		});
	}/*init()*/,
	upload:function(file) {
		//Disable controls
		this.objects.uploadBtn.prop('disabled', true);
		this.setMsg('업로드 중 입니다...', 'info');

		var formData=new FormData();
		formData.append('image', file);
		formData.append('_token', EditorData.token);
		formData.append('styleicon_id', EditorData.icon.id);
		$.ajax({
			url: EditorData.endpoints.uploadAttachment,
			type: "POST",
			data: formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			dataType:'json',
			success:function(response) {
				if(typeof response==='object' && 'type' in response && 'data' in response) {
					AttachmentEditor.clearMsg();
					if(response.type=='success') {
						AttachmentEditor.addPhoto(response.data);
						//Remove dummy if present
						AttachmentEditor.objects.list.find('figure.dummy').remove();
					} else if(response.type='error') {
						switch(response.data) {
							case 'file_proc':
							AttachmentEditor.setMsg('파일 처리 실패!', 'danger');
							break;
							case'no_file':
							AttachmentEditor.setMsg('정상적인 업로드가 이루어지지 않았습니다!', 'danger');
							break;
							case 'not_found':
							AttachmentEditor.setMsg('존재하지 않는 스타일 아이콘 입니다!', 'danger');
							break;
							case 'not_owner':
							AttachmentEditor.setMsg('편집 권한이 없습니다!', 'danger');
							break;
							default:
							AttachmentEditor.setMsg('알 수 없는 오류가 발생했습니다!', 'danger');
						}
					}
				} else {
					AttachmentEditor.setMsg('정상적인 서버 응답을 받지 못했습니다!', 'danger');
				}
			},
			error:function() {
				AttachmentEditor.setMsg('정상적인 서버 응답을 받지 못했습니다!', 'danger');
			},
			complete:function() {
				AttachmentEditor.objects.uploadBtn.prop('disabled', false);
			}
		});
	}/*upload()*/,
	addPhoto:function(img) {
		var attachment=$('<figure class="attachment"></figure>').prop('data-id', img.id);
		$('<button type="button" class="delete-btn btn btn-warning">삭제</button>').prop('data-id', img.id).appendTo(attachment);
		$('<img src="" />').prop('src', img.url).prop('width', img.width).prop('height', img.height).appendTo(attachment);
		this.objects.list.append(attachment);
	},
	delete:function(btn) {console.log(btn);
		var data={
			_token:EditorData.token,
			styleicon_id:EditorData.icon.id,
			attachment_id:btn.attr('data-id')
		};

		//Disable delete btn
		btn.prop('disabled', true);

		$.post(EditorData.endpoints.deleteAttachment, data, function(response) {
			var errorMsg=null;
			if(typeof response==='object' && 'type' in response && 'data' in response) {
				if(response.type=='success') {
					AttachmentEditor.removePhoto(response.data);
				} else if(response.type='error') {
					switch(response.data) {
						case 'file_proc':
						errorMsg='파일 처리 실패!';
						break;
						case'no_file':
						errorMsg='정상적인 업로드가 이루어지지 않았습니다!';
						break;
						case 'not_found':
						errorMsg='존재하지 않는 스타일 아이콘 입니다!';
						break;
						case 'not_owner':
						errorMsg='편집 권한이 없습니다!';
						break;
						default:
						errorMsg='알 수 없는 오류가 발생했습니다!';
					}
				}
			} else {
				errorMsg='정상적인 서버 응답을 받지 못했습니다!';
			}

			if(errorMsg) {
				AlertModal.launch(errorMsg, function(btn) {
					btn.prop('disabled', false);
				}, [btn]);
			}
		}, 'json');
	},
	removePhoto:function(id) {
		this.objects.list.find('figure[data-id="'+id+'"]').remove();
		if(this.objects.list.find('figure').length===0) {
			$('<figure class="dummy"></figure>').appendTo(this.objects.list);
		}
	},
	setMsg:function(msg,type) {
		var helperclass=null;
		switch(type) {
			case 'info':
				helperclass='text-info';
				break;
			case 'danger':
				helperclass='text-danger';
				break;
			case 'danger':
				helperclass='text-danger';
				break;
			case 'success':
				helperclass='text-success';
				break;
			default:
				helperclass='text-muted'
		}
		this.objects.toolbarMsg.html(msg).addClass(helperclass);
	},
	clearMsg:function() {
		this.objects.toolbarMsg.html(null).removeClass();
	}
};//AttachmentEditor{}

$(document).ready(function() {
	PrimaryEditor.init();
	AttachmentEditor.init();
	PinEditor.init('#PinEditModal');
});//document.ready()