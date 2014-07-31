var CategoryList={
	init:function() {
		$('#categoryList .sub-level').draggable({
			revert:'invalid',
			helper:'clone'
		});//init draggables

		$('#categoryList .top-level').droppable({
			accept:'.sub-level',
			hoverClass:'state-hover',
			drop:function(e,ui) {
				$(this).find('.category-children').append(ui.draggable);

				var targetCategory=ui.draggable.attr('data-id');
				var parentCategory=$(this).attr('data-id');

				if(ui.draggable.attr('data-parent')!=$(this).attr('data-id')) {
					CategoryList.freezeUI();
					CategoryList.requestUpdate(targetCategory,parentCategory);
				}
			}/*drop()*/
		});//init droppables
	}/*init()*/,
	updateDOM:function(list) {
		var newList=null;
		var listLength=list.length;
		for(var i=0;i<listLength;i++) {
			var topLevel=list[i];
			var topCat=$('<li class="top-level" data-id="'+topLevel.model.id+'"><a href="'+CategoryAJAX.editURL+topLevel.model.id+'">'+topLevel.model.name+'</a></li>');
			var children=$('<ul class="category-children"></ul>');
			var childrenLength=topLevel.children.length;
			for(var k=0;k<childrenLength;k++) {
				children.append('<li class="sub-level" data-id="'+topLevel.children[k].id+'" parent-id="'+topLevel.children[k].parent_id+'"><a href="'+CategoryAJAX.editURL+topLevel.children[k].id+'">'+topLevel.children[k].name+'</a></li>');
			}
			topCat.append(children);
			if(newList) {
				newList=newList.add(topCat);
			} else {
				newList=topCat;
			}
		}
		$('#categoryList').empty().append(newList);
	}/*updateDOM()*/,
	freezeUI:function() {
		$('#categoryList .top-level').droppable('destroy');
		$('#categoryList').addClass('frozen');
	}/*freezeUI()*/,
	thawUI:function() {
		$('#categoryList').removeClass('frozen');
	}/*thawUI()*/,
	requestUpdate:function(targetCategory,parentCategory) {
		var data={
			_token:CategoryAJAX._token,
			target:targetCategory,
			parent:parentCategory
		};

		$.post(CategoryAJAX.changeParent,data,function(response) {
			//Basic response validation
			if(typeof response === 'object' && 'result' in response && 'category_list' in response) {
				if(response.result=='success') {
					//
				} else if(response.result=='db_error') {
					AdminMaster.alertModal.launch('데이터베이스에 문제가 생겼습니다. 잠시 후에 다시 시도해주세요 :(');
				} else if(response.result=='input_error') {
					AdminMaster.alertModal.launch('정상적인 요청이 아닙니다. 새로고침을 해보세요 :(');
				} else {
					AdminMaster.alertModal.launch('정상적인 서버 응답을 받지 못했습니다. 새로고침을 해보세요 :(');
				}

				CategoryList.updateDOM(response.category_list);
				CategoryList.init();
				CategoryList.thawUI();
			} else {
				AdminMaster.alertModal.launch('정상적인 서버 응답을 받지 못했습니다. 새로고침을 해보세요 :(');
			}
		},'json');
	}/*requestUpdate()*/
};//CategoryList{}

$(document).ready(function() {
	CategoryList.init();
});//document.ready()