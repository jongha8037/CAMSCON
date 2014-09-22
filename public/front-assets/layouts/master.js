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
	forMobile:function() {},
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
}//PrimarySlider{}

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
	if(slides>0) {
		PrimarySlider.init(slides, '.primary-slider');
	}

	//FB Share btns
	$(document).on('click', '.fb-share-btn', null, function() {
		var url=$(this).attr('data-url');
		FB.ui({
			method: 'share',
			href: url,
		}, function(response){});
	})
});//document.ready()