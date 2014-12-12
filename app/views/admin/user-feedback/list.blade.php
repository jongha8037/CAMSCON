@extends('admin.layouts.admin-master')

@section('head_title')
User Feedback Admin - CAMSCON
@stop

@section('head_styles')
<style type="text/css">
.feedback-list {
	list-style-type: none;
	max-width:600px;
	margin:60px auto 30px auto;
	padding:0;
}

.feedback-list li {
	margin-bottom:40px;
}

.feedback-list h2 {
	font-size:23px;
	border-bottom:1px solid #ddd;
}

.feedback-list .delete-btn {
	float: right;
	margin-top: 9px;
	cursor:pointer;
	font-size: 12px;
	color: #666;
}

.feedback-list .feedback-content {
	border-bottom:1px solid #ededed;
}

.pagination-wrapper {
	text-align: center;
}

.pagination-wrapper .pagination {
	margin:0;
}
</style>
@stop

@section('content')
@if(Session::has('proc_result'))
	@if(Session::get('proc_result')=='success')
		<div class="alert alert-success">피드백 항목이 삭제되었습니다.</div>
	@elseif(Session::get('proc_result')=='db_error')
		<div class="alert alert-danger">데이터베이스 오류가 발생했습니다.</div>
	@elseif(Session::get('proc_result')=='invalid_input')
		<div class="alert alert-danger">입력값이 잘못되었습니다.</div>
	@endif
@endif

<h1>사용자 피드백 조회 <small>총 {{intval($entries->count())}}건</small></h1>

<ul id="feedbackList" class="feedback-list">
	@foreach($entries as $entry)
	<li>
		<h2>#{{$entry->id}} <small>{{$entry->created_at}}</small><span class="delete-btn glyphicon glyphicon-remove" data-id="{{$entry->id}}"></span></h2>
		<div class="feedback-content">{{autop($entry->feedback)}}</div>
	</li>
	@endforeach
</ul>

<div class="pagination-wrapper">
@if(is_object($entries)){{$entries->links()}}@endif
</div>

{{ Form::open(array( 'url'=>action('UserFeedbackController@deleteFeedback'), 'id'=>'feedbackDeleteForm' )) }}
<input type="hidden" id="feedbackIdField" name="feedback_id" />
{{ Form::close() }}
@stop

@section('footer_scripts')
<script type="text/javascript">
(function(window, document, $, module, undefined) {
	$(document).ready(function() {
		module.objx.list=$('#feedbackList');
		module.objx.form=$('#feedbackDeleteForm');
		module.objx.id_field=$('#feedbackIdField');

		module.objx.list.on('click', '.delete-btn', {deleteAction:module.deleteAction.bind(module)}, function(e) {
			//Confirm action
			var feedback_id=$(this).attr('data-id');
			if(confirm(feedback_id+'번 피드백을 삭제하시겠습니까?')) {
				e.data.deleteAction(feedback_id);
			}
		});
	});
})(window, document, jQuery, {
	/*User Feedback Admin module*/
	objx:{
		list:null,
		form:null,
		id_field:null
	},
	deleteAction:function(feedback_id) {
		this.objx.id_field.val(feedback_id);
		this.objx.form.submit();
	}
});
</script>
@stop