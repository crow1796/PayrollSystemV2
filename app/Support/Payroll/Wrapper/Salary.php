<?php

namespace App\Support\Payroll\Wrapper;

class Salary {
	protected $employee;
	protected $workDays;
	protected $workHours;
	protected $workIncomes;
	protected $grossPay;
	protected $netPay;
	protected $deductions;

	public function __construct($employee, $workDays, $workHours, $workIncomes, $deductions){
		$this->employee = $employee;
		$this->workDays = $workDays;
		$this->workHours = $workHours;
		$this->workIncomes = $workIncomes;
		$this->initialGrossPay();
		$this->deductions = $deductions;
		$this->netPay = $this->netPay();
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

	public function employee(){
		return $this->employee;
	}

	public function grossPay(){
		return $this->grossPay;
	}

	public function deductions(){
		return $this->deductions;
	}

	public function totalExpenses(){
		$totalExpenses = 0;
		foreach($this->deductions['expenses'] as $expense => $value) {
			$totalExpenses += $this->checkExpenses($value);
		}
		return $totalExpenses;
	}

	public function totalInvestments(){
		$totalInvestments = 0;
		foreach($this->deductions['investments'] as $investment){
			$totalInvestments += $investment;
		}
		return $totalInvestments;
	}

	public function netPay(){
		return ($this->grossPay - ($this->totalExpenses() + $this->totalInvestments()));
	}

	protected function checkExpenses($expenses){
		if(!is_array($expenses)){
			return $expenses;
		}
		$totalExpenses = 0;
		
		foreach($expenses as $deducts) {
			$totalExpenses += $deducts;
		}

		return $totalExpenses;
	}

	public function setDeductions($deductions){
		$this->deductions = $deductions;
		$this->netPay = $this->netPay();
	}

	protected function initialGrossPay(){
		foreach($this->workIncomes as $workIncome){
			$this->grossPay += $workIncome;
		}
	}
}