<?php

class CategoriesController extends BaseController {

	public function showDashboard() {
		$ViewData=array(
			'category_tree'=>$this->getTree()
		);

		return View::make('admin.categories.dashboard',$ViewData);
	}//showDashboard()

	public function showEditor($category_id) {
		$ViewData=array(
			'category_tree'=>$this->getTree()
		);

		if($category_id!='new') {
			//Check if category_id exists
			$category=FashionItemCategory::find(intval($category_id));

			if($category) {
				//category_id exists
				$ViewData['editTarget']=$category;
			} else {
				//Non-existent category_id
				$ViewData['editTarget']=false;
			}
		} else {
			//New brand
			$ViewData['editTarget']=null;
		}
		return View::make('admin.categories.editor',$ViewData);
		
	}//showEditor()


	private function getTree($output_type='obj') {
		$categories=FashionItemCategory::orderBy('id','asc')->get();

		$tree_temp=array();

		foreach($categories as $category) {
			if($category->parent_id==0) {
				$parentElement=new stdClass();
				$parentElement->model=$category;
				$parentElement->children=array();
				$tree_temp[$category->id]=$parentElement;
			}
		}

		foreach($categories as $category) {
			if($category->parent_id!=0) {
				$tree_temp[$category->parent_id]->children[]=$category;
			}
		}

		$tree_output=array();
		foreach ($tree_temp as $element) {
			$tree_output[]=$element;
		}

		if($output_type=='obj') {
			return $tree_output;
		} elseif($output_type=='json') {
			return json_encode($tree_output);
		} else {
			return null;
		}
	}//getTree()

	public function saveCategory() {
		Input::flash();
		$input=Input::only(
			'category_id',
			'parent_id',
			'category_name_en',
			'category_name_ko',
			'category_name_ja',
			'category_name_zh_cn',
			'category_name_zh_tw',
			'category_name_ru',
			'category_name_th',
			'category_name_es',
			'category_name_vi'
		);

		$validationRules=array(
			'category_id'=>array('sometimes','exists:fashion_item_categories,id'),
			'parent_id'=>array('required','integer','min:0'),
			'category_name_en'=>array('required'),
		);

		$messages=array(
			'required'=>'필수 항목 입니다.',
			'integer'=>'입력값이 잘못됐습니다.',
			'min'=>'입력값이 잘못됐습니다.',
			'unique'=>'데이터베이스에 이미 동일한 항목이 존재합니다.',
			'exists'=>'항목이 존재하지 않습니다!',
		);

		$validator = Validator::make($input, $validationRules, $messages);

		$validator->sometimes('parent_id','exists:fashion_item_categories,id,parent_id,0',function($input) {
			return intval($input->parent_id)!==0;
		});

		$validator->sometimes('category_name', 'unique:fashion_item_categories,name,'.$input['category_id'], function($input) {
			return !empty($input->category_id);
		});

		$validator->sometimes('category_name', 'unique:fashion_item_categories,name', function($input) {
			return empty($input->category_id);
		});

		if($validator->passes()) {
			//Set Category obj
			if(!empty($input['category_id'])) {
				$category=FashionItemCategory::find(intval($input['category_id']));
				if(!$category) {
					$category=new FashionItemCategory;
				}
			} else {
				$category=new FashionItemCategory;
			}

			//Set data
			$category->parent_id=$input['parent_id'];
			$category->name_en=$input['category_name_en'];

			$category->name_ko=$input['category_name_ko'];
			$category->name_ja=$input['category_name_ja'];
			$category->name_zh_cn=$input['category_name_zh_cn'];
			$category->name_zh_tw=$input['category_name_zh_tw'];
			$category->name_ru=$input['category_name_ru'];
			$category->name_th=$input['category_name_th'];
			$category->name_es=$input['category_name_es'];
			$category->name_vi=$input['category_name_vi'];

			if($category->save()) {
				return Redirect::action('CategoriesController@showEditor', array('category_id' => $category->id))->with('success',true);
			} else {
				return Redirect::back()->with('db_error',true);
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//saveCategory()

	public function deleteCategory() {
		Input::flash();
		$input=Input::only('category_id');

		$validationRules=array(
			'category_id'=>array('required','exists:fashion_item_categories,id'),
		);

		$messages=array(
			'required'=>'필수항목이 누락되었습니다.',
			'exists'=>'수정하고자 하는 항목이 존재하지 않습니다!'
		);

		$validator = Validator::make($input, $validationRules, $messages);

		if($validator->passes()) {
			$category=FashionItemCategory::find(intval($input['category_id']));
			$children=FashionItemCategory::where('parent_id','=',$category->id)->get();

			if(count($children)>0) {
				//Children exist
				return Redirect::back()->with('delete_error_children',true);
			} else {
				if($category->delete()) {
					return Redirect::action('CategoriesController@showDashboard')->with('delete_success',true);
				} else {
					return Redirect::back()->with('db_error',true);
				}
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//deleteBrand()

	public function changeParent() {
		$input=Input::only('target','parent');

		$validationRules=array(
			'target'=>array('required','integer','exists:fashion_item_categories,id'),
			'parent'=>array('required','integer','exists:fashion_item_categories,id,parent_id,0')
		);

		$validationHelperRules=array(
			'target'=>array('exists:fashion_item_categories,id,parent_id,0')
		);

		$messages=array(
			'required'=>'required_:attribute',
			'exists'=>'exists_:attribute'
		);

		$validator=Validator::make($input, $validationRules, $messages);
		$helper=Validator::make($input, $validationHelperRules, $messages);

		$responseObj=new stdClass();

		if($validator->passes() && $helper->fails()) {
			$category=FashionItemCategory::find($input['target']);
			$category->parent_id=$input['parent'];
			if($category->save()) {
				$responseObj->result='success';
			} else {
				$responseObj->result='db_error';
			}
		} else {
			$responseObj->result='input_error';
		}

		$responseObj->category_list=$this->getTree();

		return Response::json($responseObj);
	}//changeParent()

}