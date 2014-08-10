<?php
namespace CafeCoder\Laravel\ViewData;

class ViewDataClass {

	private $payload=array();

	public function get() {
		return $this->payload;
	}

	public function find($key=null) {
		if(array_key_exists($key,$this->payload)) {
			return $this->payload[$key];
		} else {
			return null;
		}
	}

	public function add($key=null,$value=null) {
		if((is_int($key) || is_string($key)) && !in_array($key, $this->payload)) {
			$this->payload[$key]=$value;
		}
		return $this;
	}

	public function update($key=null,$value=null) {
		if(in_array($key, $this->payload)) {
			$this->payload=$value;
		} else {
			$this->add($key,$value);
		}
		return $this;
	}

	public function remove($key=null) {
		if(in_array($key, $this->payload)) {
			unset($this->payload[$key]);
		}
		return $this;
	}

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

}
?>