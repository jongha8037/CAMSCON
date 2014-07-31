<h2 class="admin-section-title">카테고리 목록</h2>
<a href="{{action('CategoriesController@showEditor','new')}}" id="addCategoryBtn" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 새 카테고리 추가</a>
<ul id="categoryList" class="category-list">
	@foreach($category_tree as $category)
	<li class="top-level" data-id="{{$category->model->id}}">
		<a href="{{action('CategoriesController@showEditor',$category->model->id)}}" class="@if(isset($editTarget) && $editTarget->id==$category->model->id){{'current'}}@endif">{{$category->model->name}}</a>
		@if(!empty($category->children))
		<ul class="category-children">
			@foreach($category->children as $child)
			<li class="sub-level" data-id="{{$child->id}}" data-parent="{{$category->model->id}}">
				<a href="{{action('CategoriesController@showEditor',$child->id)}}" class="@if(isset($editTarget) && $editTarget->id==$child->id){{'current'}}@endif">{{$child->name}}</a>
			</li>
			@endforeach
		</ul>
		@endif
	</li>
	@endforeach
</ul>