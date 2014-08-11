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
				if(typeof confirmModal.callback==='function') {
					confirmModal.callback.apply(null,confirmModal.callbackParams);
				}
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
	}/*confirmModal{}*/,

	alertModal:{
		modal:$('#alertModal'),
		modalBody:$('#alertModalBody'),
		confirmBtn:$('#alertModalConfirm'),
		callback:null,
		callbackParams:null,
		init:function() {
			this.modal.modal({show:false});
			this.confirmBtn.on('click',null,{alertModal:this},function(e) {
				var alertModal=e.data.alertModal;
				if(typeof alertModal.callback==='function') {
					alertModal.callback.apply(null,alertModal.callbackParams);
				}
				alertModal.modal.modal('hide');
			});
		}/*init()*/,
		launch:function(msg,callback,data) {
			this.callback=callback;
			this.callbackParams=data;

			this.modalBody.empty();
			this.modalBody.append(msg);
			this.modal.modal('show');
		}/*launch()*/
	}/*alertModal()*/,

	renderLayout:function() {
		$('.admin-body').css('min-height',$.viewportH()-125);
	}/*renderLayout()*/
};//AdminMaster{}

$(document).ready(function() {
	AdminMaster.renderLayout();
	AdminMaster.confirmModal.init();
	AdminMaster.alertModal.init();
});//document.ready()

$(window).resize(function() {
	AdminMaster.renderLayout();
});