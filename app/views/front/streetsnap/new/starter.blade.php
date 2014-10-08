@extends('front.layouts.master')

@section('head_title')
Starter
@stop

@section('head_styles')
<style type="text/css">
.starter-msgs, 
.starter-new-wrapper {
	margin:25px 0px;
}

.starter-new-wrapper a {
	font-weight: 700;
	font-size:16px;
}

.starter-list-wrapper {
	margin:25px -15px;
}

.starter-list-wrapper ul {
	padding:0px;
	margin:0px;
	list-style-type: none;
}

.starter-list-wrapper ul li {
	margin-bottom:10px;
	border-bottom:1px dashed #ddd;
}

.starter-list-wrapper a {
	color:#a0a0a0;
	font-size:16px;
}

.starter-list-wrapper a:hover {
	color:#707070;
}
</style>
@stop

@section('content')

@if(Session::has('proc_result'))
<div class="starter-msgs">
	@if(Session::get('proc_result')=='success')
	<div class="post-proc-msg alert alert-success"><strong>성공!</strong> 글이 저장되었습니다.</div>
	@elseif(Session::get('proc_result')=='delete_success')
	<div class="post-proc-msg alert alert-success"><strong>성공!</strong> 글이 삭제되었습니다.</div>
	@elseif(Session::get('proc_result')=='db_error')
	<div class="post-proc-msg alert alert-danger"><strong>오류!</strong> 데이터베이스 에러가 발생했습니다.</div>
	@elseif(Session::get('proc_result')=='primary_missing')
	<div class="post-proc-msg alert alert-danger"><strong>오류!</strong> 메인사진이 없는 글은 공개할 수 없습니다.</div>
	@endif
</div>
@endif

<div class="starter-new-wrapper">
	<a href="{{action('StreetSnapEditController@showEditor')}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> 새 포스트 작성</a>
</div>

<div class="starter-list-wrapper row">
	<div class="draft-col col-xs-12 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">임시글 편집</h3>
			</div>
			<div class="panel-body">
				<ul>
					@foreach($drafts as $draft)
					<li><a href="{{action('StreetSnapEditor@showEditor', $draft->id)}}">#{{$draft->id}} ({{$draft->created_at}})</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>

	<div class="published-col col-xs-12 col-xs-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">공개된 글 편집</h3>
			</div>
			<div class="panel-body">
				<ul>
					@foreach($published as $snap)
					<li><a href="{{action('StreetSnapEditor@showEditor', $snap->id)}}">{{$snap->meta->name}} {{$snap->affiliation or ''}} {{$snap->name}} ({{$snap->created_at}})</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@stop

@section('footer_scripts')
@stop