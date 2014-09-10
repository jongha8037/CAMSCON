@extends('front.layouts.master')

@section('head_title')
Camscon
@stop

@section('head_styles')
@stop

@section('content')
<div class="breadcrumbs">
	@foreach($breadcrumbs as $key=>$breadcrumb)
		@if($key>0)
		<span class="caret-right"></span>
		@endif
		<a href="{{$breadcrumb['url']}}">{{{$breadcrumb['name']}}}</a>
	@endforeach
</div>

<div class="single-container row">
	<div id="photoCol" class="photo-col col-xs-12 col-sm-7">
		<nav class="content-nav clearfix">
			@if($prevSnap)
			<a href="{{action('StreetSnapController@getSingle', array('category'=>$category, 'slug'=>$slug, 'id'=>$prevSnap))}}" alt="" class="prev" style="background-image:url('{{asset('front-assets/layouts/content_nav_prev.png')}}');">Prev</a>
			@endif
			@if($nextSnap)
			<a href="{{action('StreetSnapController@getSingle', array('category'=>$category, 'slug'=>$slug, 'id'=>$nextSnap))}}" alt="" class="next" style="background-image:url('{{asset('front-assets/layouts/content_nav_next.png')}}');">Next</a>
			@endif
		</nav>

		<figure id="snapPrimary" class="primary-photo pinned">
			<button type="button" class="like-btn">LIKE</button>
			<span class="likes">{{$snap->cached_total_likes}}</span>
			<button type="button" class="fb-share-btn">f</button>
			<div class="pin-container"></div>
			<img src="{{$snap->primary->url}}" alt="" width="{{$snap->primary->width}}" height="{{$snap->primary->height}}" />
		</figure><!--/.primary-photo-->

		@foreach($snap->attachments as $attachment)
		<figure>
			<img src="{{$attachment->url}}" alt="" width="{{$attachment->width}}" height="{{$attachment->height}}" />
		</figure>
		@endforeach
	</div><!--/#photoCol-->
	<div id="dataCol" class="data-col col-xs-12 col-sm-5">
		<div class="icon-section">
			<h3 class="name">{{{$snap->name}}}</h3>
			<h3 class="category">{{{trim($snap->meta_type, 'Meta')}}} / {{{$snap->meta->name}}} @if($snap->user->id===Auth::user()->id){{'<a href="'.action('StreetSnapEditController@showEditor', $snap->id).'" class="btn btn-primary btn-xs">Edit</a>'}}@endif</h3>
		</div>

		<div class="notes-section">
			@if(!empty($snap->subject_comment))
			@if($snap->gender=='female')
			<h4>She says:</h4>
			@else
			<h4>He says:</h4>
			@endif
			<div class="icon-comment">
				{{autop($snap->subject_comment)}}
			</div>
			@endif

			@if(!empty($snap->photographer_comment))
			<h4>Photographer's note:</h4>
			<div class="photographers-note">
				{{autop($snap->photographer_comment)}}
			</div>
			@endif
		</div><!--/.notes-section-->

		<div class="pins-section">
			<ul id="pinList" class="pin-list">				
				<li><a href="http://uk.accessorize.com/" target="_blank" alt="" class="commerce-link" data-pin-no="1"><span class="pin-numbering">1</span> <strong class="item-name">Bracelet</strong> <span class="vendor">Accessorize</span> in <span class="category">Accessories</span></a></li>
				<li><a href="" alt="http://www.louisvuitton.com/" target="_blank" class="commerce-link" data-pin-no="2"><span class="pin-numbering">2</span> <strong class="item-name">Bag</strong> <span class="vendor">Louis Vuitton</span> in <span class="category">Bags</span></a></li>
				<li><a href="http://www.fendi.com/kr/ko" target="_blank" alt="" class="commerce-link" data-pin-no="3"><span class="pin-numbering">3</span> <strong class="item-name">Shoes</strong> <span class="vendor">Fendi</span> in <span class="category">Shoes</span></a></li>
			</ul>
		</div>

		<div class="photographer-section">
			@if($snap->user->profileImage)
			<img src="{{$snap->user->profileImage->url}}" alt="" class="profile-img" />
			@else
			<img src="{{asset('front-assets/profile/profile_default_big.png')}}" alt="" class="profile-img" />
			@endif
			<div class="profile-data">
				<strong class="name">{{{$snap->user->nickname}}}</strong>
				@if(!empty($snap->user->uri))
				<p>MY PAGE <a href="{{action('ProfileController@showProfile', $snap->user->uri)}}">{{action('ProfileController@showProfile', $snap->user->uri)}}</a></p>
				@else
				<p>MY PAGE <a href="{{action('ProfileController@showProfile', $snap->user->id)}}">{{action('ProfileController@showProfile', $snap->user->id)}}</a></p>
				@endif
				<p>Blog @if(!empty($snap->user->blog))<a href="{{$snap->user->blog}}" target="_blank">{{$snap->user->blog}}</a>@else{{'-'}}@endif</p>
				<p>Instagram @if(!empty($snap->user->instagram))<a href="http://instagram.com/{{$snap->user->instagram}}" target="_blank">{{'@'.$snap->user->instagram}}</a>@else{{'-'}}@endif</p>
			</div>
		</div>
	</div>
</div><!--/.single-container-->
@stop

@section('footer_scripts')
<script type="text/javascript">
var SingleView={
	snap:{
		id:"{{$snap->id}}"
	},
	endpoints:{
		/**/
	},
	token:"{{csrf_token()}}",
	pins:@if($snap->pins->count()){{$snap->pins->toJson()}}@else{{'[]'}}@endif,
	scale:1,
	objects:{
		targetImg:null,
		pinContainer:null,
		pinList:null
	},
	init:function() {
		this.objects.targetImg=$('#snapPrimary').find('img');
		this.objects.pinContainer=$('#snapPrimary').find('.pin-container');
		this.objects.pinList=$('#pinList');

		this.render();

		this.objects.pinList.empty();
		var plen=this.pins.length;
		for(var i=0;i<plen;i++) {
			this.objects.pinList.append( this.createListItem(this.pins[i], i+1) );
		}

		this.objects.pinList.on('mouseover', 'li', {pinContainer:this.objects.pinContainer}, function(e) {
			var pin_id=$(this).attr('data-pin-no');
			e.data.pinContainer.find('a[data-id="'+pin_id+'"]').addClass('highlight');
		});

		this.objects.pinList.on('mouseout', 'li', {pinContainer:this.objects.pinContainer}, function(e) {
			var pin_id=$(this).attr('data-pin-no');
			e.data.pinContainer.find('a[data-id="'+pin_id+'"]').removeClass('highlight');
		});

		this.objects.pinContainer.on('mouseover', 'a', {pinList:this.objects.pinList}, function(e) {
			var pin_id=$(this).attr('data-id');
			e.data.pinList.find('li[data-pin-no="'+pin_id+'"]').addClass('highlight');
		});

		this.objects.pinContainer.on('mouseout', 'a', {pinList:this.objects.pinList}, function(e) {
			var pin_id=$(this).attr('data-id');
			e.data.pinList.find('li[data-pin-no="'+pin_id+'"]').removeClass('highlight');
		});
	}/*init()*/,
	render:function() {
		this.scale=this.objects.pinContainer.outerWidth()/parseInt(this.objects.targetImg.attr('width'),10);
		this.renderPins();
	},
	renderPins:function() {
		this.objects.pinContainer.empty();
		var plen=this.pins.length;
		for(var i=0;i<plen;i++) {
			this.objects.pinContainer.append( this.createPin(this.pins[i], i+1) );
		}
	}/*renderPins()*/,
	createPin:function(pin,number) {
		var newPin=$('<a href="" data-id="" class="pin"></a>').text(number);
		if(pin.links.length>0) {
			newPin.attr('href', pin.links[0].url);
		}
		newPin.attr('data-id', pin.id);
		newPin.css({
			top:parseFloat(pin.top)*this.scale,
			left:parseFloat(pin.left)*this.scale
		});
		return newPin;
	}/*createPin()*/,
	createListItem:function(pin,number) {
		var newItem=$('<li data-pin-no=""><span class="pin-numbering"></span><div class="data-wrapper"><div class="meta"><strong class="item-name"></strong> by <span class="vendor"></span> in <span class="category"></span></div><ul class="links"></div></ul></li>');
		newItem.attr('data-pin-no', pin.id);
		newItem.find('span.pin-numbering').text(number);
		newItem.find('strong.item-name').text(pin.item_category.name);
		newItem.find('span.vendor').text(pin.brand.name);
		newItem.find('span.category').text(pin.item_category.parent.name);

		var linkList=newItem.find('ul.links');
		var linkLen=pin.links.length;
		for(var k=0;k<linkLen;k++) {
			var newLink=$('<li class="pin-link"><span class="link-name"></span> <a href="" target="_blank"></a></li>');
			newLink.find('span.link-name').text(pin.links[k].title);
			newLink.find('a').attr('href', pin.links[k].url);
			newLink.find('a').text(pin.links[k].url);

			newLink.appendTo(linkList);
		}

		return newItem;
	}/*createListItem()*/
};//SingleView{}

$(document).ready(function() {
	SingleView.init();
});

$(window).resize(function() {
	SingleView.render();
});
</script>
@stop