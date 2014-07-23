var AdminMaster={
	renderLayout:function() {
		$('.admin-body').css('min-height',$.viewportH()-125);
	}
};//AdminMaster{}

$(document).ready(function() {
	AdminMaster.renderLayout();
});//document.ready()

$(window).resize(function() {
	AdminMaster.renderLayout();
});