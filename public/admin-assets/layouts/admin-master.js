var AdminMaster={
	confirmModal:{
		modal:$('#confirmModal'),
		modalBody:$('#confirmModalBody'),
		confirmBtn:$('#confirmModalConfirm'),
		callback:null,
		callbackParams:null,
		init:function() {
			this.modal.modal({show:false});
			this.confirmBtn.on('click',null,{confirmModal:this},function(e) {
				var confirmModal=e.data.confirmModal;
				confirmModal.callback.apply(null,confirmModal.callbackParams);
				confirmModal.modal.modal('hide');
			});
		}/*init()*/,
		launch:function(msg,callback,data) {
			this.callback=callback;
			this.callbackParams=data;

			this.modalBody.empty();
			this.modalBody.append(msg);
			this.modal.modal('show');
		}/*launch()*/
	},
	renderLayout:function() {
		$('.admin-body').css('min-height',$.viewportH()-125);
	}
};//AdminMaster{}

$(document).ready(function() {
	AdminMaster.renderLayout();
	AdminMaster.confirmModal.init();
});//document.ready()

$(window).resize(function() {
	AdminMaster.renderLayout();
});