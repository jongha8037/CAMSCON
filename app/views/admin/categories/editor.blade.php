@extends('admin.layouts.admin-master')

@section('head_title')
Fashion Item Categories: Editor
@stop

@section('head_styles')
<link href="{{asset('admin-assets/categories/style.css')}}" rel="stylesheet" />
@stop

@section('content')
<!--Brand list section-->
<div class="col-xs-3">
	@include('admin.categories.list')
</div>
<!--/Brand list section-->

<!--Editor section-->
<div class="col-xs-9">
	<h2 class="admin-section-title">패션 아이템 카테고리 에디터</h2>

	<div class="category-form-wrapper">
		@if(Session::has('success'))
		<div class="alert alert-success"><strong>성공</strong> 카테고리가 저장되었습니다 :)</div>
		@endif

		@if(Session::has('delete_error_children'))
		<div class="alert alert-danger"><strong>에러</strong> 비어있지 않은 최상위 카테고리는 삭제할 수 없습니다. 하위 카테고리를 모두 이동시키거나 삭제한 뒤에 다시 시도해주세요 :(</div>
		@endif

		@if($errors->has('category_id'))
		<div class="alert alert-danger"><strong>에러</strong> {{$errors->first('category_id')}}</div>
		@endif

		@if(Session::has('db_error'))
		<div class="alert alert-danger"><strong>에러</strong> DB 오류가 발생했습니다. 잠시 후에 다시 시도해 주세요.</div>
		@endif

		{{Form::open(array('action'=>'CategoriesController@saveCategory'))}}
			<!--Category id-->
			<input type="hidden" id="categoryID" name="category_id" value="@if(Input::old('category_id')){{Input::old('category_id')}}@else{{$editTarget->id or ''}}@endif" />

			<!--Category parent-->
			<div class="form-group">
				<label for="categoryParent">상위 카테고리</label>
				<select class="form-control" id="categoryParent" name="parent_id">
					<option value="0"@if(Input::old('parent_id')==0 || (isset($editTarget) && $editTarget->parent_id==0)){{' selected="selected"'}}@endif>없음 (최상위 카테고리)</option>
					@foreach($category_tree as $category)
					<option value="{{$category->model->id}}"@if(Input::old('parent_id')==$category->model->id || (isset($editTarget) && $editTarget->parent_id==$category->model->id)){{' selected="selected"'}}@endif>{{{$category->model->name}}}</option>
					@endforeach
				</select>
				@if($errors->has('parent_id'))
				<p class="text-danger">{{$errors->first('parent_id')}}</p>
				@endif
			</div>

			<!--Category name English-->
			<div class="form-group">
				<label for="categoryNameEn">카테고리 영문 이름</label>
				<input type="text" class="form-control" id="categoryNameEn" name="category_name_en" placeholder="카테고리 영문 이름" value="@if(Input::old('category_name_en')){{Input::old('category_name_en')}}@else{{$editTarget->name_en or ''}}@endif" />
				@if($errors->has('category_name_en'))
				<p class="text-danger">{{$errors->first('category_name_en')}}</p>
				@endif
			</div>

			<!--Category name Korean-->
			<div class="form-group">
				<label for="categoryNameKo">카테고리 한글 이름</label>
				<input type="text" class="form-control" id="categoryNameKo" name="category_name_ko" placeholder="카테고리 한글 이름" value="@if(Input::old('category_name_ko')){{Input::old('category_name_ko')}}@else{{$editTarget->name_ko or ''}}@endif" />
				@if($errors->has('category_name_ko'))
				<p class="text-danger">{{$errors->first('category_name_ko')}}</p>
				@endif
			</div>

			<!--Category name Japanese-->
			<div class="form-group">
				<label for="categoryNameJa">카테고리 일본어 이름</label>
				<input type="text" class="form-control" id="categoryNameJa" name="category_name_ja" placeholder="카테고리 일본어 이름" value="@if(Input::old('category_name_ja')){{Input::old('category_name_ja')}}@else{{$editTarget->name_ja or ''}}@endif" />
				@if($errors->has('category_name_ja'))
				<p class="text-danger">{{$errors->first('category_name_ja')}}</p>
				@endif
			</div>

			<!--Category name Chinese Simplified-->
			<div class="form-group">
				<label for="categoryNameZhCn">카테고리 중국어 (간체, 중국) 이름</label>
				<input type="text" class="form-control" id="categoryNameZhCn" name="category_name_zh_cn" placeholder="카테고리 중국어 (간체, 중국) 이름" value="@if(Input::old('category_name_zh_cn')){{Input::old('category_name_zh_cn')}}@else{{$editTarget->name_zh_cn or ''}}@endif" />
				@if($errors->has('category_name_zh_cn'))
				<p class="text-danger">{{$errors->first('category_name_zh_cn')}}</p>
				@endif
			</div>

			<!--Category name Chinese Traditional-->
			<div class="form-group">
				<label for="categoryNameZhTw">카테고리 중국어 (번체, 대만) 이름</label>
				<input type="text" class="form-control" id="categoryNameZhTw" name="category_name_zh_tw" placeholder="카테고리 중국어 (번체, 대만) 이름" value="@if(Input::old('category_name_zh_tw')){{Input::old('category_name_zh_tw')}}@else{{$editTarget->name_zh_tw or ''}}@endif" />
				@if($errors->has('category_name_zh_tw'))
				<p class="text-danger">{{$errors->first('category_name_zh_tw')}}</p>
				@endif
			</div>

			<!--Category name Russian-->
			<div class="form-group">
				<label for="categoryNameRu">카테고리 러시아어 이름</label>
				<input type="text" class="form-control" id="categoryNameRu" name="category_name_ru" placeholder="카테고리 러시아어 이름" value="@if(Input::old('category_name_ru')){{Input::old('category_name_ru')}}@else{{$editTarget->name_ru or ''}}@endif" />
				@if($errors->has('category_name_ru'))
				<p class="text-danger">{{$errors->first('category_name_ru')}}</p>
				@endif
			</div>

			<!--Category name Thai-->
			<div class="form-group">
				<label for="categoryNameTh">카테고리 태국어 이름</label>
				<input type="text" class="form-control" id="categoryNameTh" name="category_name_th" placeholder="카테고리 태국어 이름" value="@if(Input::old('category_name_th')){{Input::old('category_name_th')}}@else{{$editTarget->name_th or ''}}@endif" />
				@if($errors->has('category_name_th'))
				<p class="text-danger">{{$errors->first('category_name_th')}}</p>
				@endif
			</div>

			<!--Category name Spanish-->
			<div class="form-group">
				<label for="categoryNameEs">카테고리 스페인어 이름</label>
				<input type="text" class="form-control" id="categoryNameEs" name="category_name_es" placeholder="카테고리 스페인어 이름" value="@if(Input::old('category_name_es')){{Input::old('category_name_es')}}@else{{$editTarget->name_es or ''}}@endif" />
				@if($errors->has('category_name_es'))
				<p class="text-danger">{{$errors->first('category_name_es')}}</p>
				@endif
			</div>

			<!--Category name Vietnamese-->
			<div class="form-group">
				<label for="categoryNameVi">카테고리 베트남어 이름</label>
				<input type="text" class="form-control" id="categoryNameVi" name="category_name_vi" placeholder="카테고리 베트남어 이름" value="@if(Input::old('category_name_vi')){{Input::old('category_name_vi')}}@else{{$editTarget->name_vi or ''}}@endif" />
				@if($errors->has('category_name_vi'))
				<p class="text-danger">{{$errors->first('category_name_vi')}}</p>
				@endif
			</div>

			<div class="category-submit-wrapper">
				@if(isset($editTarget))
				<button type="button" id="categoryDeleteBtn" class="btn btn-warning">삭제하기</button>
				@endif
				<button type="submit" class="btn btn-primary">저장하기</button>
			</div>
		{{Form::close()}}

		@if(isset($editTarget))
		{{Form::open(array('action'=>'CategoriesController@deleteCategory','id'=>'categoryDeleteForm'))}}
			<input type="hidden" name="category_id" value="{{$editTarget->id or ''}}" />
		{{Form::close()}}
		@endif
	</div><!--/.category-form-wrapper-->
</div>
<!--/Editor section-->
@stop

@section('footer_scripts')
<script type="text/javascript">
var CategoryAJAX={
	_token:"{{csrf_token()}}",
	changeParent:"{{action('CategoriesController@changeParent')}}",
	editURL:"{{action('CategoriesController@showEditor',array('category_id'=>null))}}/"
};

@if(is_object($editTarget))
var EditTarget={
	category_id:{{$editTarget->id}}
};
@endif

$(document).ready(function() {
	$(document).on('click','#categoryDeleteBtn',null,function() {
		AdminMaster.confirmModal.launch('카테고리를 삭제하시겠습니까? (삭제 액션은 되돌릴 수 없습니다.)',function() {
			$('#categoryDeleteForm').submit();
		},null);
	});//#brandDeleteBtn.click()
});
</script>

<script src="{{asset('admin-assets/categories/editor.js')}}"></script>
@stop