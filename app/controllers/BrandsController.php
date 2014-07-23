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
		//
	}//saveBrand()

	public function deleteBrand() {
		//
	}//deleteBrand()

}