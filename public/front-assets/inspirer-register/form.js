(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		$('#inspirerRegisterForm').on('submit', null, {handler:module.submitHandler.bind(module)}, function(e) {
			e.data.handler($(this));
		});
	});
})(window, document, jQuery, {
	/*Inspirer Register Module*/
	validationPatterns:{
		protocol:/^(http:\/\/|https:\/\/)/i
	},
	submitHandler:function(form) {
		var website=form.find('#inspirerWebsite');
		website.val( this._urlFilter(website.val()) );

		var blog=form.find('#inspirerBlog');
		blog.val( this._urlFilter(blog.val()) );

		var facebook=form.find('#inspirerFacebook');
		facebook.val( this._urlFilter(facebook.val()) );
	},
	_urlFilter:function(rawUrl) {
		var filterResult=null;
		if(rawUrl.length>0) {
			if( this.validationPatterns.protocol.test(rawUrl)!==true ) {
				filterResult='http://'+rawUrl;
			} else {
				filterResult=rawUrl;
			}
		}
		return filterResult;
	}
});