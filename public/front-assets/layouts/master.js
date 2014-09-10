var CategoryNavigation={
	objects:{
		nav:null
	},
	subMenus:[],
	init:function() {
		this.objects.nav=$('nav.category-nav');

		//Campus
		this.addSubmenu('campus');
		
		//Gender
		this.addSubmenu('gender');
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
			timer:null
		}
		subMenu.obj=this.objects.nav.find('.'+key+'-sub-menu')
		this.subMenus.push(subMenu);
		var index=this.subMenus.length-1;

		this.objects.nav.on('mouseover', '.'+key+'-menu', {subMenu:this.subMenus[index], index:index}, function(e) {
			CategoryNavigation.hideAll(e.data.index);
			if(!e.data.subMenu.obj.hasClass('active')) {
				e.data.subMenu.obj.addClass('active');
			}
		}).on('mouseout', '.'+key+'-menu', {subMenu:this.subMenus[index], index:index}, function(e) {
			var self=e.data.subMenu;
			self.timer=setTimeout(function() {
				self.obj.removeClass('active');
			}, 500);
		});
	}
};//CategoryNavigation{}

$(document).ready(function() {
	//Login Btn
	$('#camsconLoginBtn').click(function(e) {
		e.preventDefault();
		if(typeof LoginModal === 'object') {
			LoginModal.launch();
		}
	});

	CategoryNavigation.init();
});//document.ready()