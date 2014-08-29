<!--Upload Modal-->
<div id="UploadModal" class="modal fade">
	<div class="modal-dialog" style="max-width:400px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">업로드</h4>
			</div>
			<div class="modal-body">
				<div class="upload-msg"></div>
				<input type="file" name="file" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="upload-btn btn btn-primary">확인</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/Upload Modal-->

<script type="text/javascript">
var UploadModal={
	jqo:null,
	callback:null,
	callbackParams:null,
	init:function(selector) {
		this.jqo=$(selector);
		this.jqo.modal({show:false});
		this.jqo.on('click','.upload-btn',{uploadModal:this},function(e) {
			var uploadModal=e.data.uploadModal;
			if(typeof uploadModal.callback==='function') {
				uploadModal.callbackParams.push(uploadModal.jqo.find('input').get(0).files[0]);
				uploadModal.callback.apply(null,uploadModal.callbackParams);
			}
			uploadModal.jqo.modal('hide');
		});
	}/*init()*/,
	launch:function(msg,callback,data) {
		//Setup callback
		this.callback=callback;
		if(data==null) {
			this.callbackParams=new Array();
		} else if(data.isArray()) {
			this.callbackParams=data;
		} else {
			this.callbackParams=[data];
		}

		//Launch modal
		this.jqo.find('.upload-msg').empty().append(msg);
		this.jqo.modal('show');
	}/*launch()*/
};/*confirmModal{}*/

$(document).ready(function() {
	UploadModal.init('#UploadModal');
});
</script>