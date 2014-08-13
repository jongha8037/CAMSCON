<!--Alert Modal-->
<div id="AlertModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">알림</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="confirm-btn btn btn-primary">확인</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/Alert Modal-->

<script type="text/javascript">
var AlertModal={
	jqo:null,
	callback:null,
	callbackParams:null,
	init:function(selector) {
		this.jqo=$(selector);
		this.jqo.modal({show:false});
		this.jqo.on('click','.confirm-btn',{alertModal:this},function(e) {
			var alertModal=e.data.alertModal;
			if(typeof alertModal.callback==='function') {
				alertModal.callback.apply(null,alertModal.callbackParams);
			}
			alertModal.jqo.modal('hide');
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
}/*alertModal()*/

$(document).ready(function() {
	AlertModal.init('#AlertModal');
});
</script>