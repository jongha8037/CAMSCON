<h2 class="admin-section-title">브랜드 목록</h2>
<a href="{{action('BrandsController@showEditor','new')}}" id="addBrandBtn" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 새 브랜드 추가</a>
<ul id="brandList" class="brand-list">
	@foreach($brands as $brand)
		<li><a href="{{action('BrandsController@showEditor',$brand->id)}}" class="@if(isset($editTarget) && $editTarget->id==$brand->id){{'current'}}@endif">{{$brand->name}}</a></li>
	@endforeach
</ul>