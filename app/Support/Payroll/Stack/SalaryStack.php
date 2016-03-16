<?php

namespace App\Support\Payroll\Stack;

use App\Support\Payroll\Wrapper\DailyWorkedHours;
use App\Support\Payroll\Stack\Abstracts\AbstractStack as Stack;

class SalaryStack{
	protected $stack;

	public function __construct(){
		$this->stack = [];
	}

	public function add($value){
		$this->stack[] = $value;
	}

	public function delete($index){
		if(isset($this->stack[$index])){
			unset($this->stack[$index]);
			return true;
		}
		return false;
	}

	public function all(){
		return $this->stack;
	}

	public function get($index){
		return $this->stack[$index];
	}

	public function set($index, $value){
		$this->stack[$index] = $value;
	}

	public function employees(){
		$employees = [];
		foreach($this->stack as $salary){
		    $employees[] = $salary->employee();
		}
		return $employees;
	}
}