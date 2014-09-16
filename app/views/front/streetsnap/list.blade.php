@extends('front.layouts.master')

@section('head_styles')
@stop

@section('content')
<div class="primary-slider">
	<div class="inner clearfix">
		<figure class="slide"><img src="{{asset('assets/primary-slider/1.jpg')}}" /></figure>
		<figure class="slide"><img src="{{asset('assets/primary-slider/2.jpg')}}" /></figure>
		<figure class="slide"><img src="{{asset('assets/primary-slider/3.jpg')}}" /></figure>
		<figure class="slide"><img src="{{asset('assets/primary-slider/4.jpg')}}" /></figure>
	</div>
</div>

<div id="snapListWrapper" class="snap-list">
	@if(intval($snapCount)===0)
	<h4 style="text-align:center;">아직 등록된 컨텐츠가 없습니다! :(</h4>
	@endif
</div>
@stop

@section('footer_scripts')
<script type="text/javascript" src="{{asset('packages/isotope/isotope.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('packages/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>

<script type="text/javascript">
var ListView={
	objx:{
		wrapper:null
	},
	display:{
		screenWidth:0,
		wrapperWidth:0,
		columnWidth:0
	},
	isotope:{
		status:'inactive'
	},
	snaps:{{$snaps}},
	endpoints:{
		loadMore:"{{$loadMore}}"
	},
	status:'idle',
	init:function() {
		//Set wrapper object
		this.objx.wrapper=$('#snapListWrapper');

		//Set display dimensions
		this.display.screenWidth=$.viewportW();
		this.display.wrapperWidth=this.objx.wrapper.innerWidth();
		if(this.display.screenWidth<768) {//Mobile
			this.display.columnWidth=this.display.wrapperWidth;
		} else if(this.display.screenWidth<992) {//Tablets
			this.display.columnWidth=this.display.wrapperWidth/3;
		} else if(this.display.screenWidth<1200) {//Laptops
			this.display.columnWidth=this.display.wrapperWidth/3;
		} else {//Desktops
			this.display.columnWidth=this.display.wrapperWidth/3;
		}

		//Init isotope
		if(this.isotope.status=='active') {
			this.objx.wrapper.empty().isotope('destroy');
		}
		this.objx.wrapper.isotope({
			itemSelector:'.snap-wrapper',
			layoutMode:'masonry',
			masonry:{
				columnWidth:this.display.columnWidth
			}
		});
		this.isotope.status='active';

		//Proc initial data
		this.appendSnaps(this.snaps.data);

		//Scroll event
		$(window).on('scroll', null, null, function() {
			if((document.body.scrollHeight-$(window).scrollTop() < $.viewportH()+500) && (ListView.status=='idle')) {
				ListView.status='loading';
				ListView.requestMoreSnaps();
			}
		});
	},
	appendSnaps:function(snaps) {
		//Create array of snap nodes from data
		var snapObjx=[];
		var slen=snaps.length;for(var i=0;i<slen;i++) {
			var wrapper=$('<div class="snap-wrapper hidden"></div>');
			var inner=$('<div class="snap-inner"></div>');

			var snap=$('<figure class="snap"></figure>');
			var likeBtnClass=null;
			if(snaps[i].liked.length>0) {
				likeBtnClass='liked';
			}
			$('<button type="button" data-type="" data-id="" class="like-btn">LIKE</button>').attr('data-type', 'StreetSnap').attr('data-id', snaps[i].id).addClass(likeBtnClass).appendTo(snap);
			$('<span class="likes"></span>').text(snaps[i].cached_total_likes).appendTo(snap);
			$('<button type="button" class="fb-share-btn" data-url="">f</button>').attr('data-url', snaps[i].single_url).appendTo(snap);
			var link=$('<a href=""></a>').attr('href', snaps[i].single_url);
			$('<img src="" alt="" class="snap-primary" />').attr('src', snaps[i].primary.url).attr('width', snaps[i].primary.width).attr('height', snaps[i].primary.height).appendTo(link);
			link.appendTo(snap);
			snap.appendTo(inner);

			var meta=$('<div class="meta-container clearfix"></div>');
			
			if(snaps[i].user.profile_image) {
				$('<img src="" alt="" class="author-profile" />').attr('src', snaps[i].user.profile_image.url).appendTo(meta);
			} else {
				$('<img src="" alt="" class="author-profile" />').attr('src', "{{asset('front-assets/profile/profile_default_small.png')}}").appendTo(meta);
			}

			var subjectMeta=$('<div class="subject-meta"></div>');
			$('<strong></strong>').text(snaps[i].name).appendTo(subjectMeta);
			$('<strong class="meta-category"></strong>').text(snaps[i].meta.name).appendTo(subjectMeta);
			subjectMeta.appendTo(meta);

			var authorMeta=$('<div class="author-meta">Photo by </div>').append(snaps[i].user.nickname).appendTo(meta);

			meta.appendTo(inner);

			inner.appendTo(wrapper);

			snapObjx.push(wrapper.get(0));
		}

		var wrapper=this.objx.wrapper;
		wrapper.append(snapObjx).imagesLoaded(function() {
			wrapper.find('.snap-wrapper').each(function() {
				$(this).removeClass('hidden');
			});
			wrapper.isotope('appended', snapObjx);
		});
	},
	refreshLayout:function() {
		this.objx.wrapper.isotope('layout');
	},
	requestMoreSnaps:function() {
		if( (typeof this.endpoints.loadMore != 'undefined') && (this.endpoints.loadMore != '') ) {
			$.get(this.endpoints.loadMore, null, function(response) {
				if(typeof response==='object' && 'snaps' in response && 'more_url' in response) {
					ListView.endpoints.loadMore=response.more_url;
					ListView.snaps.data.concat(response.snaps.data);
					ListView.appendSnaps(response.snaps.data);
					ListView.status='idle';
				}
			}, 'json');
		} else {
			this.status='end';
		}
	}
};//ListView{}

$(document).ready(function() {
	ListView.init();
	LikeButtons.init();
});

$(window).resize(function() {
	var newScreenWidth=$.viewportW();
	if(newScreenWidth!=ListView.display.screenWidth) {
		ListView.init();
	}
});

var LikeButtons={
	init:function() {
		$(document).on('click', '.like-btn', null, function(e) {
			LikeButtons.like($(this));
		});
	},
	like:function(btn) {
		btn.prop('disabled', true);

		var data={
			_token:"{{csrf_token()}}",
			target_type:btn.attr('data-type'),
			target_id:btn.attr('data-id')
		}

		$.post("{{action('LikeController@procLike')}}", data, function(response) {
			//console.log(response);
			if(response.proc=='liked') {
				btn.addClass('liked');
			} else if(response.proc=='canceled') {
				btn.removeClass('liked');
			}
			if('total' in response) {
				btn.siblings('span.likes').text(response.total);
			}
		}, 'json').fail(function(response) {
			//console.log(response.status);
			if(response.status==401) {
				if(typeof LoginModal === 'object') {
					LoginModal.launch();
				}
			}
		}).always(function() {
			btn.prop('disabled', false);
		});
	}
};//LikeButtons{}
</script>
@stop