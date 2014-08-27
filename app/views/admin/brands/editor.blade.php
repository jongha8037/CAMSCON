@extends('admin.layouts.admin-master')

@section('head_title')
Fashion Brands: Editor
@stop

@section('head_styles')
<link href="{{asset('admin-assets/brands/style.css')}}" rel="stylesheet" />
@stop

@section('content')
<!--Brand list section-->
<div class="col-xs-3">
	@include('admin.brands.list')
</div>
<!--/Brand list section-->

<!--Editor section-->
<div class="col-xs-9">
	<h2 class="admin-section-title">패션 브랜드 에디터</h2>

	<div class="brand-form-wrapper">
		@if(Session::has('success'))
		<div class="alert alert-success"><strong>성공</strong> 브랜드가 저장되었습니다 :)</div>
		@endif

		@if($errors->has('brand_id'))
		<div class="brand-id-error alert alert-danger"><strong>에러</strong> {{$errors->first('brand_id')}}</div>
		@endif

		@if(Session::has('db_error'))
		<div class="alert alert-danger"><strong>에러</strong> DB 오류가 발생했습니다. 잠시 후에 다시 시도해 주세요.</div>
		@endif

		{{Form::open(array('action'=>'BrandsController@saveBrand'))}}
			<!--Brand id-->
			<input type="hidden" id="brandID" name="brand_id" value="@if(Input::old('brand_id')){{Input::old('brand_id')}}@else{{$editTarget->id or ''}}@endif" />

			<!--Brand name English-->
			<div class="form-group">
				<label for="brandNameEn">브랜드 영문 이름</label>
				<input type="text" class="form-control" id="brandNameEn" name="brand_name_en" placeholder="브랜드 영문 이름" value="@if(Input::old('brand_name_en')){{Input::old('brand_name_en')}}@else{{$editTarget->name_en or ''}}@endif" />
				@if($errors->has('brand_name_en'))
				<p class="text-danger">{{$errors->first('brand_name_en')}}</p>
				@endif
			</div>

			<!--Brand name Korean-->
			<div class="form-group">
				<label for="brandNameKo">브랜드 한글 이름</label>
				<input type="text" class="form-control" id="brandNameKo" name="brand_name_ko" placeholder="브랜드 한글 이름" value="@if(Input::old('brand_name_ko')){{Input::old('brand_name_ko')}}@else{{$editTarget->name_ko or ''}}@endif" />
				@if($errors->has('brand_name_ko'))
				<p class="text-danger">{{$errors->first('brand_name_ko')}}</p>
				@endif
			</div>

			<!--Brand name Japanese-->
			<div class="form-group">
				<label for="brandNameJa">브랜드 일본어 이름</label>
				<input type="text" class="form-control" id="brandNameJa" name="brand_name_ja" placeholder="브랜드 일본어 이름" value="@if(Input::old('brand_name_ja')){{Input::old('brand_name_ja')}}@else{{$editTarget->name_ja or ''}}@endif" />
				@if($errors->has('brand_name_ja'))
				<p class="text-danger">{{$errors->first('brand_name_ja')}}</p>
				@endif
			</div>

			<!--Brand name Chinese Simplified-->
			<div class="form-group">
				<label for="brandNameZhCn">브랜드 중국어 (간체, 중국) 이름</label>
				<input type="text" class="form-control" id="brandNameZhCn" name="brand_name_zh_cn" placeholder="브랜드 중국어 (간체, 중국) 이름" value="@if(Input::old('brand_name_zh_cn')){{Input::old('brand_name_zh_cn')}}@else{{$editTarget->name_zh_cn or ''}}@endif" />
				@if($errors->has('brand_name_zh_cn'))
				<p class="text-danger">{{$errors->first('brand_name_zh_cn')}}</p>
				@endif
			</div>

			<!--Brand name Chinese Traditional-->
			<div class="form-group">
				<label for="brandNameZhTw">브랜드 중국어 (번체, 대만) 이름</label>
				<input type="text" class="form-control" id="brandNameZhTw" name="brand_name_zh_tw" placeholder="브랜드 중국어 (번체, 대만) 이름" value="@if(Input::old('brand_name_zh_tw')){{Input::old('brand_name_zh_tw')}}@else{{$editTarget->name_zh_tw or ''}}@endif" />
				@if($errors->has('brand_name_zh_tw'))
				<p class="text-danger">{{$errors->first('brand_name_zh_tw')}}</p>
				@endif
			</div>

			<!--Brand name Russian-->
			<div class="form-group">
				<label for="brandNameRu">브랜드 러시아어 이름</label>
				<input type="text" class="form-control" id="brandNameRu" name="brand_name_ru" placeholder="브랜드 러시아어 이름" value="@if(Input::old('brand_name_ru')){{Input::old('brand_name_ru')}}@else{{$editTarget->name_ru or ''}}@endif" />
				@if($errors->has('brand_name_ru'))
				<p class="text-danger">{{$errors->first('brand_name_ru')}}</p>
				@endif
			</div>

			<!--Brand name Thai-->
			<div class="form-group">
				<label for="brandNameTh">브랜드 태국어 이름</label>
				<input type="text" class="form-control" id="brandNameTh" name="brand_name_th" placeholder="브랜드 태국어 이름" value="@if(Input::old('brand_name_th')){{Input::old('brand_name_th')}}@else{{$editTarget->name_th or ''}}@endif" />
				@if($errors->has('brand_name_th'))
				<p class="text-danger">{{$errors->first('brand_name_th')}}</p>
				@endif
			</div>

			<!--Brand name Spanish-->
			<div class="form-group">
				<label for="brandNameEs">브랜드 스페인어 이름</label>
				<input type="text" class="form-control" id="brandNameEs" name="brand_name_es" placeholder="브랜드 스페인어 이름" value="@if(Input::old('brand_name_es')){{Input::old('brand_name_es')}}@else{{$editTarget->name_es or ''}}@endif" />
				@if($errors->has('brand_name_es'))
				<p class="text-danger">{{$errors->first('brand_name_es')}}</p>
				@endif
			</div>

			<!--Brand name Vietnamese-->
			<div class="form-group">
				<label for="brandNameVi">브랜드 베트남어 이름</label>
				<input type="text" class="form-control" id="brandNameVi" name="brand_name_vi" placeholder="브랜드 베트남어 이름" value="@if(Input::old('brand_name_vi')){{Input::old('brand_name_vi')}}@else{{$editTarget->name_vi or ''}}@endif" />
				@if($errors->has('brand_name_vi'))
				<p class="text-danger">{{$errors->first('brand_name_vi')}}</p>
				@endif
			</div>

			<!--Brand url-->
			<div class="form-group">
				<label for="brandURL">브랜드 웹사이트 주소</label>
				<input type="text" class="form-control" id="brandURL" name="brand_url" placeholder="url" value="@if(Input::old('brand_url')){{Input::old('brand_url')}}@else{{$editTarget->url or ''}}@endif" />
				@if($errors->has('brand_url'))
				<p class="text-danger">{{$errors->first('brand_url')}}</p>
				@endif
			</div>

			<!--Brand description-->
			<div class="form-group">
				<label for="brandDescription">브랜드 설명 (메모)</label>
				<textarea class="form-control" id="brandDescription" name="brand_description" placeholder="브랜드 설명">@if(Input::old('brand_description')){{Input::old('brand_description')}}@else{{$editTarget->description or ''}}@endif</textarea>
				@if($errors->has('brand_description'))
				<p class="text-danger">{{$errors->first('brand_description')}}</p>
				@endif
			</div>

			<div class="brand-submit-wrapper">
				@if(isset($editTarget))
				<button type="button" id="brandDeleteBtn" class="btn btn-warning">삭제하기</button>
				@endif
				<button type="submit" class="btn btn-primary">저장하기</button>
			</div>
		{{Form::close()}}

		@if(isset($editTarget))
		{{Form::open(array('action'=>'BrandsController@deleteBrand','id'=>'brandDeleteForm'))}}
			<input type="hidden" name="brand_id" value="{{$editTarget->id}}" />
		{{Form::close()}}
		@endif
	</div><!--/.brand-form-wrapper-->
</div>
<!--/Editor section-->
@stop

@section('footer_scripts')
<!-- <script src="{{asset('admin-assets/style-icon/editor.js')}}"></script> -->
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click','#brandDeleteBtn',null,function() {
		AdminMaster.confirmModal.launch('브랜드를 삭제하시겠습니까? (삭제 액션은 되돌릴 수 없습니다.)',function() {
			$('#brandDeleteForm').submit();
		},null);
	});//#brandDeleteBtn.click()
});
</script>
@stop