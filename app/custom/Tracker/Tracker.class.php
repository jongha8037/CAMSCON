<?php
namespace CafeCoder\Laravel\Tracker;

class TrackerClass {

	private $totalPageCount=0;
	private $restrictedPageCount=0;
	
	public function get() {
		$outputObj=new \stdClass();
		$outputObj->total_page_count=$this->totalPageCount;
		$outputObj->restricted_page_count=$this->restrictedPageCount;
		
		return $outputObj;
	}//get()

	public function addPageCount() {
		$this->totalPageCount++;
		
		return $this;
	}//addPageCount()

	public function addRestrictedCount() {
		$this->restrictedPageCount++;

		return $this;
	}
}
?>
