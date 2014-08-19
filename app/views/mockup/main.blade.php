@extends('mockup.layout')

@section('head_title')
Main page mockup
@stop

@section('content')
@include('mockup.top-slider')

<div class="list-container row">
	<div id="listCol1" class="col-xs-12 col-sm-4"></div>
	<div id="listCol2" class="col-xs-12 col-sm-4"></div>
	<div id="listCol3" class="col-xs-12 col-sm-4"></div>
</div><!--/.list-view-->
@stop

@section('footer_scripts')
<script type="text/javascript">
var IconsList=[
	@foreach($icons as $icon)
	{
		type:"icon",
		icon:{
			photo:"{{$icon->photo}}",
			name:"{{{$icon->name}}}",
			meta:"{{{$icon->meta}}}"
		},
		author:{
			photo:"{{$icon->author->photo}}",
			name:"{{$icon->author->name}}"
		}
	},
	@endforeach
	{type:"last-item"}
];
</script>

<script type="text/javascript">
	$(document).ready(function() {
		if(Array.isArray(IconsList)) {
			var i=0;
			var c=1;
			while(IconsList[i].type!=='last-item') {
				var imgContainer=$('<figure class="img-container"></figure>');
				var likeBtn=$('<button type="button" class="like-btn">LIKE</button>').appendTo(imgContainer);
				var likes=$('<span class="likes">398</span>').appendTo(imgContainer);
				var fbShareBtn=$('<button type="button" class="fb-share-btn">f</button>').appendTo(imgContainer);
				var img=$('<img src="'+IconsList[i].icon.photo+'" alt="" />').appendTo(imgContainer);

				var metaContainer=$('<div class="meta-container clearfix"></div>');
				var authorProfile=$('<img src="'+IconsList[i].author.photo+'" alt="" class="author-profile" />').appendTo(metaContainer);
				var iconMeta=$('<div class="icon-meta"><strong>'+IconsList[i].icon.name+'</strong><strong class="category">'+IconsList[i].icon.meta+'</strong></div>').appendTo(metaContainer);
				var authorMeta=$('<div class="author-meta">Photo by '+IconsList[i].author.name+'</div>').appendTo(metaContainer);

				var item=$('<div class="list-item"></div>');
				item.append(imgContainer).append(metaContainer);

				if(c>3) {c=1;}
				$('#listCol'+c).append(item);

				i++;c++;
			}//while()
		}//if array
	});//document.ready()
</script>
@stop