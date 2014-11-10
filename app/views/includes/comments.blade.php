<h4>Comments ({{count($comments)}})</h4>

<div id="commentListWrapper" class="comment-list-wrapper">
	<ul id="commentList" class="comment-list"></ul>
</div><!--/#commentListWrapper-->

<button type="button" id="commentsLoginBtn" class="comments-login-btn btn btn-primary">로그인하고 댓글 작성 <span class="glyphicon glyphicon-comment"></span></button>

<div id="primaryCommentEditor" class="primary-comment-editor comment-editor">
	<div id="primaryCommentEditable" class="primary-comment-editable comment-editable" contenteditable="true"></div>
	<button type="submit" class="comment-submit-btn">Post Comment</button>
</div>

<style type="text/css">
.comment-list-wrapper {
	border:1px solid #afafaf;
	margin-bottom:10px;
	max-height:500px;
}

.comment-list {
	margin:0px;
	padding:0px;
	list-style-type: none;
}

.comments-login-btn {
	width:100%;
	font-size: 16px;
	font-weight: 700;
	display: none;
}

.login-false .comments-login-btn {
	display: block;
}

.login-false .primary-comment-editor {
	display: none;
}

.comment-editable {
	display:inline-block;
	width:100%;
	padding:5px;
	min-height: 52px;
	border: 1px solid #afafaf;
	overflow: hidden;
}

.comment-editable:focus {
	outline:none;
}

.primary-comment-editable {
	margin-bottom:10px;
}

.primary-comment-editor .comment-submit-btn {
	background-color:#1b1b1b;
	border: 0;
	color: #fff;
	width: 100%;
	padding: 7px 0px;
	font-size: 16px;
}

.posting .primary-comment-editor .comment-submit-btn {

}
</style>

<script type="text/javascript">
/*CommentsModule*/
var CommentsModule={
	objx:{
		root:null,
		primaryEditor:null
	},
	login_status:@if(Auth::check()){{'true'}}@else{{'false'}}@endif,
	user_id:@if(Auth::check()){{Auth::user()->id}}@else{{'null'}}@endif,
	comments:{{$comments->toJson()}},
	target:{
		type:"{{$target_type}}",
		id:"{{$target_id}}"
	},
	init:function(rootJQO) {
		//Set objects
		this.objx.root=rootJQO;
		this.objx.primaryEditor=$('#primaryCommentEditor');

		//Setup initial mode class on root element
		if(this.login_status===false) {
			this.objx.root.addClass('login-false');
		}

		//Bind callback to LoginModal{}
		if(this.login_status===false) {
			LoginModal.bindCallback(this.loginCallback.bind(this));
		}

		//Bind event handlers
		this.objx.root.on('click', '#commentsLoginBtn', null, function() {
			if(LoginModal && typeof(LoginModal)==='object' && typeof(LoginModal.launch)==='function') {
				LoginModal.launch.apply(LoginModal);
			} else {
				console.error('LoginModal is not available!');
			}
		});

		this.objx.root.on('click', '.comment-submit-btn', {postAction:this.primaryPost.bind(this)}, function(e) {
			e.data.postAction();
		});
	}/*init()*/,
	updateData:function(comments) {
		this.comments=comments;
	}/*updateData()*/,
	renderComments:function() {}/*renderComments()*/,
	loginCallback:function(user) {
		if(typeof(user)==='object' && 'id' in user && 'nickname' in user) {
			this.login_status=true;
			this.user_id=user.id;
			this.objx.root.removeClass('login-false');
		} else {
			console.error('Injected user object is invalid!');
		}
	}/*loginCallback()*/,
	primaryPost:function() {
		//Disable primary editor
		this.objx.root.addClass('posting');
		var editable=this.objx.primaryEditor.find('.comment-editable');
		console.log(editable.html());
	}/*primaryPost()*/,
	disablePrimary:function() {}/*disablePrimary()*/,
	enablePrimary:function() {}/*enablePrimary()*/,
	primaryPostResponse:function(response) {}/*primaryPostResponse()*/
};//CommentsModule{}
</script>