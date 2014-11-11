<h4>Comments (<span id="commentCount">{{count($comments)}}</span>)</h4>

<div id="commentListWrapper" class="comment-list-wrapper">
	<ul id="commentList" class="comment-list">
		@foreach($comments as $comment)
		<li class="comment-item">
			@if($comment->user->profileImage)
			<img src="{{$comment->user->profileImage->url}}" class="profile-image">
			@else
			<img src="{{asset('front-assets/profile/profile_default_big.png')}}" class="profile-image">
			@endif

			<div class="comment-wrapper">
				<div class="comment-header">
					<span class="author-nickname">{{{$comment->user->nickname}}}</span>
					@if(is_object($comment->user) && is_object(Auth::user()) && Auth::user()->id===$comment->user->id)
					<a href="#" class="delete-btn glyphicon glyphicon-remove" data-id="{{$comment->id}}"></a>
					<a href="#" class="edit-btn glyphicon glyphicon-pencil"></a>
					@endif
				</div>
				<div class="comment-body">
					<input type="hidden" class="edit-cache" />
					<div class="comment-editable">{{$comment->comment}}</div>
					<div class="editable-controls">
						<button type="button" class="cancel-btn btn btn-default btn-xs">취소</button>
						<button type="submit" class="save-btn btn btn-primary btn-xs" data-id="{{$comment->id}}">저장</button>
					</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div><!--/#commentListWrapper-->

<button type="button" id="commentsLoginBtn" class="comments-login-btn btn btn-primary">로그인하고 댓글 작성 <span class="glyphicon glyphicon-comment"></span></button>

<div id="primaryCommentEditor" class="primary-comment-editor comment-editor">
	<div id="primaryCommentEditable" class="primary-comment-editable comment-editable" contenteditable="true"></div>
	<button type="submit" class="primary-submit-btn">Post Comment</button>
</div>

<?php include(app_path().'/views/includes/comments.handlebars.php');//Include Handlebars templates ?>

<script type="text/javascript">
/*CommentsModule*/
var CommentsModule={
	objx:{
		root:null,
		commentListWrapper:null,
		commentList:null,
		primaryEditor:null,
		primaryEditable:null,
		commentCount:null
	},
	login_status:@if(Auth::check()){{'true'}}@else{{'false'}}@endif,
	user_id:@if(Auth::check()){{Auth::user()->id}}@else{{'null'}}@endif,
	comments:{{$comments->toJson()}},
	target:{
		type:"{{$target_type}}",
		id:"{{$target_id}}"
	},
	ajax:{
		csrf_token:"{{csrf_token()}}",
		save_url:"{{action('CommentController@saveComment')}}",
		delete_url:"{{action('CommentController@deleteComment')}}",
		get_url:"{{action('CommentController@getComments', array('target_type'=>$target_type, 'target_id'=>$target_id))}}"
	},
	defaults:{
		profile_img:"{{asset('front-assets/profile/profile_default_big.png')}}",
	},
	templates:{
		commentDefault:null,
		withControls:null
	},
	init:function(rootJQO) {
		//Set objects
		this.objx.root=rootJQO;
		this.objx.commentListWrapper=rootJQO.find('#commentListWrapper');
		this.objx.commentList=rootJQO.find('#commentList');
		this.objx.primaryEditor=$('#primaryCommentEditor');
		this.objx.primaryEditable=this.objx.primaryEditor.find('.comment-editable');
		this.objx.commentCount=$('#commentCount');

		//Compile handlebar templates
		this.templates.commentDefault=Handlebars.compile($('#commentTemplate').html());
		this.templates.withControls=Handlebars.compile($('#commentTemplateWithControls').html());

		//Setup initial mode class on root element
		if(this.login_status===false) {
			this.objx.root.addClass('login-false');
		}

		//Bind callback to LoginModal{}
		if(this.login_status===false) {
			LoginModal.bindCallback(this.loginCallback.bind(this));
		}

		//Bind event handlers
		/*Login btn*/
		this.objx.root.on('click', '#commentsLoginBtn', null, function() {
			if(LoginModal && typeof(LoginModal)==='object' && typeof(LoginModal.launch)==='function') {
				LoginModal.launch.apply(LoginModal);
			} else {
				console.error('LoginModal is not available!');
			}
		});

		/*Primary save btn*/
		this.objx.root.on('click', '.primary-submit-btn', {postAction:this.primaryPost.bind(this)}, function(e) {
			e.data.postAction();
		});

		/*Edit btn*/
		this.objx.root.on('click', '.edit-btn', {callback:this.enableInline.bind(this)}, function(e) {
			e.preventDefault();
			e.data.callback($(this), e);
		});

		/*Edit cancel-btn*/
		this.objx.root.on('click', '.cancel-btn', {callback:this.disableInline.bind(this)}, function(e) {
			e.data.callback($(this), e, true);
		});

		/*Edit save-btn*/
		this.objx.root.on('click', '.save-btn', {postAction:this.inlinePost.bind(this)}, function(e) {
			e.data.postAction($(this), e);
		});

		/*Delete btn*/
		this.objx.root.on('click', '.delete-btn', {callback:this.deleteComment.bind(this)}, function(e) {
			e.preventDefault();
			ConfirmModal.launch('댓글을 삭제합니다.', e.data.callback, [$(this), e]);
		});
	}/*init()*/,
	deleteComment:function(jqo, e) {
		var data={
			_token:this.ajax.csrf_token,
			self_id:jqo.attr('data-id')
		};

		//POST
		var cm=this;
		$.post(this.ajax.delete_url, data, function(response) {
			//Validate response
			if(typeof(response)==='object' && 'type' in response && 'msg' in response && 'comments' in response) {
				//Valid response
				if(response.type=='success') {
					//Update comments list
					var updateList=cm.updateList.bind(cm);
					updateList(response.comments);
				} else {
					//Display error msg
					AlertModal.launch(response.msg);
				}
			} else {
				//Invalid response
				AlertModal.launch('서버로부터 정상적인 응답을 받지 못했습니다 :( <br>잠시 후에 다시 시도해 주세요.');
			}
		}, 'json').error(function(jqXHR) {
			var ajaxFailure=cm.onAjaxFailure.bind(cm);
			ajaxFailure(jqXHR);
		});
	},
	enableInline:function(jqo, e) {
		var commentItem=jqo.parents('.comment-item');
		commentItem.addClass('edit-mode');
		var editable=commentItem.find('.comment-editable');
		commentItem.find('.edit-cache').val(editable.html());
		editable.prop('contenteditable', true);
	},
	disableInline:function(jqo, e, preserveContent) {
		var commentItem=jqo.parents('.comment-item');
		commentItem.removeClass('edit-mode');
		var editable=commentItem.find('.comment-editable');
		if(preserveContent) {
			editable.html(commentItem.find('.edit-cache').val());
		}
		editable.prop('contenteditable', false);
	},
	inlinePost:function(jqo, e) {
		//Disable inline editor, don't preserve content
		this.disableInline(jqo, e);

		var data={
			_token:this.ajax.csrf_token,
			target_type:this.target.type,
			target_id:this.target.id,
			content:jqo.parents('.comment-item').find('.comment-editable').html(),
			self_id:jqo.attr('data-id')
		};

		//POST
		var cm=this;
		$.post(this.ajax.save_url, data, function(response) {
			//Validate response
			if(typeof(response)==='object' && 'type' in response && 'msg' in response && 'comments' in response) {
				//Valid response
				var handler=cm.inlinePostResponse.bind(cm);
				handler(response);
			} else {
				//Invalid response
				AlertModal.launch('서버로부터 정상적인 응답을 받지 못했습니다 :( <br>잠시 후에 다시 시도해 주세요.');
			}
		}, 'json').error(function(jqXHR) {
			var ajaxFailure=cm.onAjaxFailure.bind(cm);
			ajaxFailure(jqXHR);
		});
	}/*inlinePost*/,
	inlinePostResponse:function(response) {
		if(response.type=='success') {
			//Update comments list
			this.updateList(response.comments);
		} else {
			//Display error msg
			AlertModal.launch(response.msg);
		}
	},
	getComments:function(scrollToBottom) {
		var data={
			_token:this.ajax.csrf_token,
			target_type:this.target.type,
			target_id:this.target.id
		};

		var cm=this;
		$.get(this.ajax.get_url, data, function(response) {
			//Validate response
			if(typeof(response)==='object' && 'type' in response && 'msg' in response && 'comments' in response) {
				//Handle success/error
				if(response.type==='success') {
					var updateList=cm.updateList.bind(cm);
					updateList(response.comments, scrollToBottom);
				} else {
					console.error(response.msg);
				}
			} else {
				console.error('서버로부터 정상적인 응답을 받지 못했습니다!');
			}
		}, 'json');
	}/*getComments()*/,
	updateList:function(comments, scrollToBottom) {
		//Detach commentList
		this.objx.commentList.detach().empty();

		this.comments=comments;

		var clen=comments.length;
		for(var i=0;i<clen;i++) {
			var context={
				profile_img:null,
				author_nickname:comments[i].user.nickname,
				comment_id:comments[i].id,
				comment:comments[i].comment
			};

			if(comments[i].user.profile_image) {
				context.profile_img=comments[i].user.profile_image.url;
			} else {
				context.profile_img=this.defaults.profile_img;
			}

			if(comments[i].user_id==this.user_id) {
				this.objx.commentList.append($(this.templates.withControls(context)));
			} else {
				this.objx.commentList.append($(this.templates.commentDefault(context)));
			}
		}

		this.objx.commentListWrapper.append(this.objx.commentList);

		//Update commentCount
		this.objx.commentCount.text(clen);

		/*Removed scroll bar
		if(scrollToBottom) {
			var scrollH=this.objx.commentListWrapper.get(0).scrollHeight;
			this.objx.commentListWrapper.animate({scrollTop:scrollH}, 200);
		}
		*/
	}/*updateData()*/,
	loginCallback:function(user) {
		if(typeof(user)==='object' && 'id' in user && 'nickname' in user) {
			this.login_status=true;
			this.user_id=user.id;
			this.objx.root.removeClass('login-false');
			this.getComments();
		} else {
			console.error('Injected user object is invalid!');
		}
	}/*loginCallback()*/,
	primaryPost:function() {
		//Disable primary editor
		this.disablePrimary();

		var data={
			_token:this.ajax.csrf_token,
			target_type:this.target.type,
			target_id:this.target.id,
			content:this.objx.primaryEditor.find('.comment-editable').html()
		};

		//POST
		var cm=this;
		$.post(this.ajax.save_url, data, function(response) {
			var enablePrimary=cm.enablePrimary.bind(cm);

			//Validate response
			if(typeof(response)==='object' && 'type' in response && 'msg' in response && 'comments' in response) {
				//Valid response
				var handler=cm.primaryPostResponse.bind(cm);
				handler(response);
			} else {
				//Invalid response
				AlertModal.launch('서버로부터 정상적인 응답을 받지 못했습니다 :( <br>잠시 후에 다시 시도해 주세요.');

				//Enable primary editor
				enablePrimary(true);
			}
		}, 'json').error(function(jqXHR) {
			var ajaxFailure=cm.onAjaxFailure.bind(cm);
			ajaxFailure(jqXHR);
		});
	}/*primaryPost()*/,
	disablePrimary:function() {
		this.objx.root.addClass('posting');
		this.objx.primaryEditable.prop('contenteditable', false);
		this.objx.primaryEditor.find('.comment-submit-btn').prop('disabled', true);
	}/*disablePrimary()*/,
	enablePrimary:function(preserveContent) {
		this.objx.root.removeClass('posting');
		this.objx.primaryEditable.prop('contenteditable', true);
		this.objx.primaryEditor.find('.comment-submit-btn').prop('disabled', false);
		if(preserveContent!==true) {
			this.objx.primaryEditable.html(null);
		}
		this.objx.primaryEditable.focus();
	}/*enablePrimary()*/,
	primaryPostResponse:function(response) {
		if(response.type=='success') {
			//Update comments list and scroll to bottom
			this.updateList(response.comments, true);

			//Enable primary editor
			this.enablePrimary();
		} else {
			//Display error msg
			AlertModal.launch(response.msg);

			//Enable primary editor
			this.enablePrimary(true);
		}
	}/*primaryPostResponse()*/,
	onAjaxFailure:function(jqXHR) {
		var msg=null;
		switch(jqXHR.status) {
			case 401:
				msg='세션이 만료되었습니다 :) 다시 로그인 해주세요!';
				break;
			case 500:
				msg='';
				break;
			default:
				msg='';
		}

		//Maybe show error msg
		if(msg) {
			AlertModal.launch(msg);
		}

		//Enable primary editor and preserve content
		this.enablePrimary(true);
	}
};//CommentsModule{}
</script>