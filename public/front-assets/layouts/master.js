//IE<9 work around for supporting .bind()
if (!Function.prototype.bind) {
  Function.prototype.bind = function (oThis) {
    if (typeof this !== "function") {
      // closest thing possible to the ECMAScript 5 internal IsCallable function
      throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
    }

    var aArgs = Array.prototype.slice.call(arguments, 1),
        fToBind = this,
        fNOP = function () {},
        fBound = function () {
          return fToBind.apply(this instanceof fNOP && oThis
                                 ? this
                                 : oThis,
                               aArgs.concat(Array.prototype.slice.call(arguments)));
        };

    fNOP.prototype = this.prototype;
    fBound.prototype = new fNOP();

    return fBound;
  };
}

//Category Navigation Module
var CategoryNavigation={
	objects:{
		nav:null
	},
	subMenus:[],
	init:function() {
		this.objects.nav=$('nav.category-nav');

		//Campus
		this.addSubmenu('campus');

		//Street
		this.addSubmenu('street');

		//Blog (Fashion people)
		this.addSubmenu('blog');

		//Fashion week
		this.addSubmenu('fashionweek');

		//Festival
		this.addSubmenu('festival');
		
		//Gender
		this.addSubmenu('gender');

		var vpw=$.viewportW();
		if(vpw<768) {
			this.forMobile();
		} else if(vpw<992){
			this.forTablet();
		} else if(vpw<1200) {
			this.forDesktop();
		} else {
			this.forDesktop();
		}
	},
	forMobile:function() {
		//Trigger 2nd depth
		this.objects.nav.on('click', '.mobile-cat-btn', null, function(e) {
			e.preventDefault();
			var catListWrapper=$(this).siblings('.category-list-wrapper');

			catListWrapper.css('height', $.viewportH()-106);

			if(catListWrapper.hasClass('active')) {
				catListWrapper.removeClass('active');
			} else {
				catListWrapper.addClass('active');
			}
		});

		//Trigger 3rd depths
		var mlen=this.subMenus.length;
		for(var i=0;i<mlen;i++) {
			this.subMenus[i].obj.siblings('a').click(function(e) {e.preventDefault();});

			this.objects.nav.on('click', '.'+this.subMenus[i].key+'-menu', null, function(e) {
				$(this).find('.sub-menu').css('height', $.viewportH()-53);

				if(!$(this).hasClass('active')) {
					$(this).addClass('active');
				}
			});
		}

		//Close 3rd depths
		this.objects.nav.on('click', '.close-btn', null, function(e) {
			e.stopPropagation();
			var parent=$(this).parents('.active');
			if(parent.hasClass('active')) {
				parent.removeClass('active');
			}
		});
	},
	forTablet:function() {
		var mlen=this.subMenus.length;
		for(var i=0;i<mlen;i++) {
			this.subMenus[i].obj.siblings('a').click(function(e) {e.preventDefault();});
			this.objects.nav.on('click', '.'+this.subMenus[i].key+'-menu', {subMenu:this.subMenus[i], index:i}, function(e) {
				var subMenu=e.data.subMenu.obj;
				if(subMenu.hasClass('active')) {
					subMenu.removeClass('active');
				} else {
					CategoryNavigation.hideAll(e.data.index);
					if(!e.data.subMenu.obj.hasClass('active')) {
						e.data.subMenu.obj.addClass('active');
					}
				}
			});
		}
	},
	forDesktop:function() {
		var mlen=this.subMenus.length;
		for(var i=0;i<mlen;i++) {
			this.objects.nav.on('mouseover', '.'+this.subMenus[i].key+'-menu', {subMenu:this.subMenus[i], index:i}, function(e) {
				CategoryNavigation.hideAll(e.data.index);
				if(!e.data.subMenu.obj.hasClass('active')) {
					e.data.subMenu.obj.addClass('active');
				}
			}).on('mouseout', '.'+this.subMenus[i].key+'-menu', {subMenu:this.subMenus[i], index:i}, function(e) {
				var self=e.data.subMenu;
				self.timer=setTimeout(function() {
					self.obj.removeClass('active');
				}, 500);
			});
		}
	},
	hideAll:function(exception) {
		var mlen=this.subMenus.length;
		for(var i=0;i<mlen;i++) {
			if(i!=exception) {
				this.subMenus[i].obj.removeClass('active');
			}
			clearTimeout(this.subMenus[i].timer);
		}
	},
	addSubmenu:function(key) {
		var subMenu={
			obj:null,
			key:null,
			timer:null
		}
		subMenu.obj=this.objects.nav.find('.'+key+'-sub-menu');
		subMenu.key=key;
		this.subMenus.push(subMenu);
	}
};//CategoryNavigation{}

//Primary Slider Module
var PrimarySlider={
	slides:0,
	timer:null,
	position:1,
	objx:{
		slider:null,
		inner:null
	},
	init:function(slides,selector) {
		this.slides=slides;
		this.objx.slider=$(selector);
		this.objx.inner=this.objx.slider.find('.inner');
		this.objx.inner.css({width:this.slides*100+'%'});
		this.objx.slider.find('.slide').css({width:100/this.slides+'%'});

		this.setTimer();
	},
	setTimer:function() {
		var slider=this;
		this.timer=setTimeout(function() {
			slider.move();
		}, 4000);
	},
	move:function() {
		var slider=this;
		this.objx.inner.animate({
			left:(-1)*this.position*100+'%'
		},
		400,/*Duration*/
		function() {
			if(slider.position<(slider.slides-1)) {
				slider.position++;
			} else {
				slider.position=0;
			}			
			slider.setTimer();
		});
	}
};//PrimarySlider{}

//Bottom Fixed Bar module
var BottomFixedBar={
	initStatus:false,
	objx:{
		layoutFooter:null
	},
	animLength:33,
	status:'visible',/*visible, hidden, in_motion*/
	timer:null,
	init:function(layoutFooterObj) {
		if($.viewportW()>=768) {
			/*layoutFooterObj must be a jQuery object*/
			this.objx.layoutFooter=layoutFooterObj;

			//Hide on scroll
			$(window).on('scroll', null, {moveAction:this.move.bind(this)}, function(e) {
				e.data.moveAction('hide');
			});

			this.initStatus=true;
		}
	},
	move:function(targetState) {
		if(this.initStatus===true) {
			var targetPos=null;
			if(targetState=='hide' && this.status=='visible') {
				targetPos=(-1)*this.animLength;
			} else if(targetState=='show' && this.status=='hidden') {
				targetPos=0;
			}

			if(targetPos!==null) {
				self=this;
				self.status='in_motion';
				this.objx.layoutFooter.animate({bottom:targetPos}, 320, function() {
					if(targetState=='hide') {
						self.status='hidden';
					} else if(targetState=='show') {
						self.status='visible';
					}
				});
			}
		}
	}
};//BottomFixedBar{}

$(document).ready(function() {
	//Login Btn
	$('#camsconLoginBtn').click(function(e) {
		e.preventDefault();
		if(typeof LoginModal === 'object') {
			LoginModal.launch();
		}
	});

	//CategoryNavigation
	CategoryNavigation.init();

	//PrimarySlider
	var slides=$('.primary-slider .slide').length;
	if(slides>1) {
		PrimarySlider.init(slides, '.primary-slider');
	}

	//FB Share btns
	$(document).on('click', '.fb-share-btn', null, function() {
		var url=$(this).attr('data-url');
		FB.ui({
			method: 'share',
			href: url,
		}, function(response){});
	});

	//Scroll to top btn
	$('#scrollTopBtn').on('click', null, null, function() {
		$('body').animate({scrollTop:0}, 400);
	});

	//Init Bottom Fixed Bar module
	BottomFixedBar.init($('#layoutFooter'));
});//document.ready()