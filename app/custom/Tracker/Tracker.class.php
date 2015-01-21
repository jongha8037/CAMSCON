<?php
namespace CafeCoder\Laravel\Tracker;
use App;

class TrackerClass {

	private $totalPageCount=0;
	private $restrictedPageCount=0;
	private $isRestrictedPage=false;
	private $session;

	public function __construct() {
		$this->session=App::make('session');

		if($this->session->has('restricted_page_count')) {
			$this->restrictedPageCount=$this->session->get('restricted_page_count');
		}

		if($this->session->has('total_page_count')) {
			$this->totalPageCount=$this->session->get('total_page_count');
		}
	}
	
	public function get() {
		$outputObj=new \stdClass();
		$outputObj->total_page_count=$this->totalPageCount;
		$outputObj->restricted_page_count=$this->restrictedPageCount;
		$outputObj->is_restricted_page=$this->isRestrictedPage;
		
		return $outputObj;
	}//get()

	public function addPageCount() {
		$this->totalPageCount++;
		$this->session->put('total_page_count', $this->totalPageCount);
		
		return $this;
	}//addPageCount()

	public function addRestrictedCount() {
		$this->restrictedPageCount++;
		$this->session->put('restricted_page_count', $this->restrictedPageCount);

		return $this;
	}

	public function isRestrictedPage($value=false) {
		if($value===true || $value===false) {
			$this->isRestrictedPage=$value;
		}

		return $this;
	}
}
?>
