var PinEngine={
	mode:'view',
	image:{
		object:null,
		width:0,
		height:0,
		offset:{
			top:0,
			left:0
		},
		pos:{
			top:0,
			left:0
		},
		restraints:{
			topMin:0,
			topMax:0/*Always 0*/,
			leftMin:0,
			leftMax:0/*Always 0*/
		}
	},
	imageContainer:{
		object:null,
		width:0,
		height:0
	},
	pinContainer:{
		object:null
	},
	init:function() {
		this.imageContainer.object=$('.image-container');
		this.loadImage(ImageData.url);
		this.pinContainer.object=$('.image-container .pin-container');
		var img=this.image;

		//Event listeners for getting click pos
		this.imageContainer.object.on('click','img',null,function(e) {
			if(PinEngine.mode=='edit') {
				PinEngine.addPin(e.pageX-img.offset.left,e.pageY-img.offset.top);
				console.log(e.pageX-img.offset.left,e.pageY-img.offset.top)
			}
		});
	}/*init()*/,
	loadImage:function(url) {
		var img=this.image;
		var imageContainer=this.imageContainer;

		img.object=$('<img src="" alt="" />');
		img.object.one('load',function() {
			img.object.draggable({
				start:function(e,ui) {
					imageContainer.object.addClass('move');
					PinEngine.hidePins();
				},
				stop:function(e,ui) {
					imageContainer.object.removeClass('move');
					var fixedPos={};
					if(ui.position.top>0) {
						fixedPos.top=0;
					}
					if(ui.position.left>0) {
						fixedPos.left=0;
					}
					if(ui.position.top<PinEngine.image.restraints.topMin) {
						fixedPos.top=PinEngine.image.restraints.topMin;
					}
					if(ui.position.left<PinEngine.image.restraints.leftMin) {
						fixedPos.left=PinEngine.image.restraints.leftMin;
					}
					ui.helper.animate(fixedPos,200,function() {
						img.offset=ui.helper.offset();
						img.pos=ui.helper.position();
						PinEngine.renderPinsEdit();
					});
				}
			});
			img.object.draggable('disable');

			//Get image size
			img.width=img.object[0].width;
			img.height=img.object[0].height;

			//Add image to DOM
			imageContainer.object.append(img.object);

			//Get imageContainer size
			imageContainer.width=imageContainer.object.outerWidth();
			imageContainer.height=imageContainer.object.outerHeight();
			imageContainer.object.css({
				width:imageContainer.width,
				height:imageContainer.height
			});

			//Calculate drag restraints
			img.restraints.topMin=imageContainer.height-img.height;
			img.restraints.leftMin=imageContainer.width-img.width;
		});
		
		//Load image
		img.object.prop('src',url);
	}/*loadImage()*/,
	editMode:function() {
		$('.image-container').css('height',$('.image-container').outerHeight());
		$('.image-container').removeClass('view').addClass('edit');
		$('.image-container img').draggable('enable');
		//Get image offset
		this.image.offset=this.image.object.offset();
		this.image.pos=this.image.object.position();
		//Render pins
		this.renderPinsEdit();
		this.mode='edit';
	}/*editMode()*/,
	viewMode:function() {
		$('.image-container').css('height','');
		$('.image-container').removeClass('edit').addClass('view');
		$('.image-container img').draggable('disable');
		//Set relative position of image back to 0,0
		this.image.object.css({top:0,left:0});
		this.image.offset=this.image.object.offset();
		this.image.pos=this.image.object.position();
		//Render pins
		this.renderPinsView();
		this.mode='view';
	}/*viewMode()*/,
	addPin:function(x,y) {
		//Check max pin restraint
		if(EditorData.pins.length>=9) {
			console.log('Max pins');
		} else {
			//Create new pin object
			var newPin=new PinClass($('<div class="pin"></div>'),x,y);
			PinData.push(newPin);

			//Render in image container (Edit mode)
			this.pinContainer.object.append(newPin.object);
			this.renderPinsEdit();

			//Add pin edit controlls

		}
	}/*addPin()*/,
	renderPinsEdit:function() {
		var dl=PinData.length;
		for(var i=0;i<dl;i++) {
			PinData[i].object.text(i+1);
			PinData[i].object.css({left:PinData[i].x+PinEngine.image.pos.left-10,top:PinData[i].y+PinEngine.image.pos.top-10});
			PinData[i].object.fadeIn(200);
		}
	}/*renderPinsEdit()*/,
	renderPinsView:function() {
		var dl=PinData.length;
		var scale={
			horizontal:this.imageContainer.width/this.image.width,
			vertical:this.imageContainer.height/this.image.height
		};console.log(scale);
		for(var i=0;i<dl;i++) {
			PinData[i].object.text(i+1);
			PinData[i].object.css({
				left:PinData[i].x*scale.horizontal-10,
				top:PinData[i].y*scale.vertical-10
			});
			PinData[i].object.fadeIn(200);
		}
	}/*renderPinsView()*/,
	hidePins:function() {
		var dl=PinData.length;
		for(var i=0;i<dl;i++) {
			PinData[i].object.fadeOut(200);
		}
	}
};//PinEngine{}

function PinClass(object,x,y) {
	this.object=object;
	this.x=x;
	this.y=y;
	this.brand=null,
	this.item=null,
	this.link=null
}//PinClass()