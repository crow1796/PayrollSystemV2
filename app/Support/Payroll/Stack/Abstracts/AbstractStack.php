<?php

namespace App\Support\Payroll\Stack\Abstracts;
use App\Support\Payroll\Stack\Contracts\Stack;

abstract class AbstractStack implements Stack {
	protected $stack;

	public function __construct(){
		$this->stack = [];
	}

	public function add($key, $value){
		$this->stack[$key][] = $value;
	}

	public function delete($key, $index){
		if(isset($this->stack[$key][$index])){
			unset($this->stack[$key][$index]);
			return true;
		}
		return false;
	}

	public function all(){
		return $this->stack;
	}

	public function get($key, $index){
		return $this->stack[$key][$index];
	}

	public function set($key, $index, $value){
		$this->stack[$key][$index] = $value;
	}
}