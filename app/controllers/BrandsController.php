<?php

class BrandsController extends BaseController {

	public function showDashboard() {
		$ViewData=array(
			'brands'=>$this->getList()
		);

		return View::make('admin.brands.dashboard',$ViewData);
	}//showDashboard()

	public function showEditor($brand_id) {
		$ViewData=array(
			'brands'=>$this->getList()
		);

		if($brand_id!='new') {
			//Check if brand_id exists
			$brand=FashionBrand::find(intval($brand_id));
			if($brand) {
				//brand_id exists
				$ViewData['editTarget']=$brand;
			} else {
				//Non-existent brand_id
				$ViewData['editTarget']=false;
			}
		} else {
			//New brand
			$ViewData['editTarget']=null;
		}
		return View::make('admin.brands.editor',$ViewData);
		
	}//showEditor()

	private function getList() {
		return FashionBrand::orderBy('name','asc')->get();
	}//getList()

	public function saveBrand() {
		Input::flash();
		$input=Input::only('brand_id','brand_name','brand_url','brand_description');

		$validationRules=array(
			'brand_id'=>array('sometimes','exists:fashion_brands,id'),
			'brand_name'=>array('required'),
			'brand_url'=>array('sometimes','url'),
			'brand_description'=>array('sometimes')
		);

		$messages=array(
			'required'=>'필수 항목 입니다.',
			'unique'=>'데이터베이스에 이미 동일한 항목이 존재합니다.',
			'exists'=>'수정하고자 하는 항목이 존재하지 않습니다!',
			'url'=>'url 형식이 잘못됐습니다!'
		);

		$validator = Validator::make($input, $validationRules, $messages);

		$validator->sometimes('brand_name', 'unique:fashion_brands,name,'.$input['brand_id'], function($input) {
			return !empty($input->brand_id);
		});

		$validator->sometimes('brand_name', 'unique:fashion_brands,name', function($input) {
			return empty($input->brand_id);
		});

		if($validator->passes()) {
			//Set Brand obj
			if(!empty($input['brand_id'])) {
				$brand=FashionBrand::find(intval($input['brand_id']));
				if(!$brand) {
					$brand=new FashionBrand;
				}
			} else {
				$brand=new FashionBrand;
			}

			//Set data
			$brand->name=$input['brand_name'];
			$brand->url=$input['brand_url'];
			$brand->description=$input['brand_description'];

			if($brand->save()) {
				return Redirect::action('BrandsController@showEditor', array('brand_id' => $brand->id))->with('success',true);
			} else {
				return Redirect::back()->with('db_error',true);
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//saveBrand()

	public function deleteBrand() {
		Input::flash();
		$input=Input::only('brand_id');

		$validationRules=array(
			'brand_id'=>array('required','exists:fashion_brands,id'),
		);

		$messages=array(
			'required'=>'필수항목이 누락되었습니다.',
			'exists'=>'수정하고자 하는 항목이 존재하지 않습니다!'
		);

		$validator = Validator::make($input, $validationRules, $messages);

		if($validator->passes()) {
			$brand=FashionBrand::find(intval($input['brand_id']));

			if($brand->delete()) {
				return Redirect::action('BrandsController@showDashboard')->with('delete_success',true);
			} else {
				return Redirect::back()->with('db_error',true);
			}
		} else {
			return Redirect::back()->withErrors($validator);
		}
	}//deleteBrand()

}