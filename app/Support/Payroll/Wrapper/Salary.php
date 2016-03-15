<?php

namespace App\Support\Payroll\Wrapper;

class Salary {
	protected $workDays;
	protected $workHours;
	protected $workIncomes;

	public function __construct($workDays, $workHours, $workIncomes){
		$this->workDays = $workDays;
		$this->workHours = $workHours;
		$this->workIncomes = $workIncomes;
	}

	public function setWorkDays($workDays){
		$this->workDays = $workDays;
	}

	public function setWorkHours($workHours){
		$this->workHours = $workHours;
	}

	public function setWorkIncomes($workIncomes){
		$this->workIncomes = $workIncomes;
	}

	public function workDays(){
		return $this->workDays;
	}

	public function workHours(){
		return $this->workHours;
	}

	public function workIncomes(){
		return $this->workIncomes;
	}
}