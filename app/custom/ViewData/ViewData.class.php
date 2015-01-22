<?php
namespace CafeCoder\Laravel\ViewData;

class ViewDataClass {

	private $payload=array();

	private $meta_tags=array(
		'title'=>null,
		'meta_description'=>null,
		'meta_tags'=>array()
	);

	private $og_tags=array();

	private $protected=array('meta_tags', 'og_tags');

	/*Basic methods
	--------------------------------------------------------*/
	public function get() {
		$viewData=$this->payload;
		$viewData['meta_tags']=$this->meta_tags;
		$viewData['og_tags']=$this->og_tags;
		return $viewData;
	}

	public function find($key=null) {
		if(array_key_exists($key,$this->payload)) {
			return $this->payload[$key];
		} else {
			return null;
		}
	}

	public function add($key=null,$value=null) {
		if((is_int($key) || is_string($key)) && !array_key_exists($key, $this->payload) && !in_array($key, $this->protected)) {
			$this->payload[$key]=$value;
		}
		return $this;
	}

	public function update($key=null,$value=null) {
		if(array_key_exists($key, $this->payload) && !in_array($key, $this->protected)) {
			$this->payload=$value;
		} else {
			$this->add($key,$value);
		}
		return $this;
	}

	public function remove($key=null) {
		if(array_key_exists($key, $this->payload) && !in_array($key, $this->protected)) {
			unset($this->payload[$key]);
		}
		return $this;
	}

	/*Temporarily removed to protect $this->payload['SEO']
	public function merge($data=null) {
		if(is_array($data)) {
			$this->payload=array_merge($this->payload,$data);
		}
		return $this;
	}

	public function replace($data=null) {
		if(is_array($data)) {
			$this->payload=$data;
		}
		return $this;
	}
	*/

	/*SEO data setters
	--------------------------------------------------------*/
	public function setTitle($title=null) {
		if(isset($title)) {
			//
		}
	}

	public function setDescription($description=null) {
		//
	}

	public function addTag($tag=null) {
		//
	}

	private function escape_meta() {
		//
		echo(strip_tags(preg_replace("/\r\n|\r|\n/", ' ', $snap->photographer_comment)));
	}

	private function escape_tag() {
		//
	}

}
?>