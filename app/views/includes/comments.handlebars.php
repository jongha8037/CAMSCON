<!--Default Handlebars template for comments-->
<script id="commentTemplate" type="text/x-handlebars-template">
<li class="comment-item">
	<img src="{{{profile_img}}}" class="profile-image" />

	<div class="comment-wrapper">
		<div class="comment-header">
			<span class="author-nickname">{{author_nickname}}</span>
		</div>
		<div class="comment-body">
			<div class="comment-editable">{{{comment}}}</div>
		</div>
	</div>
</li>
</script>

<!--Handlebars template for comments with edit/delete controls-->
<script id="commentTemplateWithControls" type="text/x-handlebars-template">
<li class="comment-item">
	<img src="{{{profile_img}}}" class="profile-image" />

	<div class="comment-wrapper">
		<div class="comment-header">
			<span class="author-nickname">{{author_nickname}}</span>
			<a href="#" class="delete-btn glyphicon glyphicon-remove" data-id="{{{comment_id}}}"></a>
			<a href="#" class="edit-btn glyphicon glyphicon-pencil"></a>
		</div>
		<div class="comment-body">
			<input type="hidden" class="edit-cache" />
			<div class="comment-editable">{{{comment}}}</div>
			<div class="editable-controls">
				<button type="button" class="cancel-btn btn btn-default btn-xs">취소</button>
				<button type="submit" class="save-btn btn btn-primary btn-xs" data-id="{{{comment_id}}}">저장</button>
			</div>
		</div>
	</div>
</li>
</script>