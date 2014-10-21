/*Textarea Autoresize

Copyright (c) 2014 CafeCoder(http://cafecoder.me),  Louis Lazaris (http://www.impressivewebs.com)

Permission is hereby granted, free of charge, 
to any person obtaining a copy of this software and associated documentation files (the "Software"), 
to deal in the Software without restriction, including without limitation the rights to 
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

//

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

;(function($, window, document, undefined) {
	
	$.widget('cafecoder.autoResize', {

		_create:function() {
			this.hiddenDiv=$(document.createElement('div')).addClass('textarea-autoresize-hidden').css({
				width:this.element.css('width'),
				fontFamily:this.element.css('font-family'),
				fontSize:this.element.css('font-size'),
				lineHeight:this.element.css('line-height'),
				paddingTop:this.element.css('paddingTop'),
				paddingRight:this.element.css('paddingRight'),
				paddingBottom:this.element.css('paddingBottom'),
				paddingLeft:this.element.css('paddingLeft'),
				borderTopWidth:this.element.css('borderTopWidth'),
				borderRightWidth:this.element.css('borderRightWidth'),
				borderBottomWidth:this.element.css('borderBottomWidth'),
				borderLeftWidth:this.element.css('borderLeftWidth')
			}).appendTo('body');

			this.element.addClass('textarea-autoresize').on('keyup.autoresize', null, {hiddenDiv:this.hiddenDiv}, this._resize);
		},

		_resize:function(e) {
			var content = $(this).val();
			content = content.replace(/\n/g, '<br>');

			var hiddenDiv=e.data.hiddenDiv;
			hiddenDiv.html(content + ' ');

			$(this).css('height', hiddenDiv.outerHeight());
		},

		destroy:function() {
			this.hiddenDiv.remove();

			this.element.removeClass('textarea-autoresize').attr('style', null).off('keyup.autoresize');

			$.Widget.prototype.destroy.call(this);
		}

	});

})(jQuery, window, document);