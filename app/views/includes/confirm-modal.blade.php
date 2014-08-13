<!--Confirm Modal-->
<div id="ConfirmModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">확인</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="confirm-btn btn btn-primary">확인</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/Confirm Modal-->

<script type="text/javascript">
var ConfirmModal={
	jqo:null,
	callback:null,
	callbackParams:null,
	init:function(selector) {
		this.jqo=$(selector);
		this.jqo.modal({show:false});
		this.jqo.on('click','.confirm-btn',{confirmModal:this},function(e) {
			var confirmModal=e.data.confirmModal;
			if(typeof confirmModal.callback==='function') {
				confirmModal.callback.apply(null,confirmModal.callbackParams);
			}
			confirmModal.jqo.modal('hide');
		});
	}/*init()*/,
	launch:function(msg,callback,data) {
		//Setup callback
		this.callback=callback;
		this.callbackParams=data;

		//Launch modal
		this.jqo.find('.modal-body').empty().append(msg);
		this.jqo.modal('show');
	}/*launch()*/
}/*confirmModal{}*/

$(document).ready(function() {
	ConfirmModal.init('#ConfirmModal');
});
</script>