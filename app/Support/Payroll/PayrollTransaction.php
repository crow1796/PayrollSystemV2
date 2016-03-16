<?php

namespace App\Support\Payroll;
use App\Support\Payroll\Calculator\DailyWorkedHoursCalculator;
use App\Support\Payroll\Stack\DailyWorkedHoursStack;
use App\Support\Payroll\Stack\SalaryStack;
use App\Support\Payroll\Calculator\SalaryCalculator;

class PayrollTransaction {

	protected $dailyWorkedHoursCalculator;
	protected $dailyWorkedHoursStack;
	protected $salaryCalculator;
	protected $salaryStack;

	public function __construct(DailyWorkedHoursCalculator $dailyWorkedHoursCalculator, 
								DailyWorkedHoursStack $dailyWorkedHoursStack,
								SalaryCalculator $salaryCalculator){
		$this->dailyWorkedHoursCalculator = $dailyWorkedHoursCalculator;
		$this->dailyWorkedHoursStack = $dailyWorkedHoursStack;
		$this->salaryCalculator = $salaryCalculator;
	}

	public function transact($data){
		$employees = \App\DailyRecord::where(function($query) use($data){
		    $query->where('record_date', '>=', $data['cutoff_start'])
		            ->where('record_date', '<=', $data['cutoff_end']);
		})->get()->groupBy('employee_id');
		$this->mainIterate($employees);
		if(strtolower($data['cutoff']) == 'second'){
			$this->salaryCalculator->deduct();
		}
		return $this->salaryStack;
	}

	/**
	 * Start iterating through employees that has daily records from cutoff_start to cutoff_end.
	 * @param  mixed $employees             
	 */
	public function mainIterate($employees){
		array_walk($employees, [$this, 'iterateEmployees']);
	}

	private function iterateEmployees($employee, $key){
		array_walk($employee, function($employeeDailyRecordsCollection){
			array_walk($employeeDailyRecordsCollection, [$this, 'transformToSalary']);
		});
		$this->salaryStack = $this->salaryCalculator->calculate($this->dailyWorkedHoursStack); #returns SalaryStack
	}

	/**
	 * Calculate daily worked hours, then calculate salary.
	 * @param   $employeeDailyRecords 
	 * @param   $key                  
	 * @return mixed                       
	 */
	private function transformToSalary($employeeDailyRecords, $key){
		foreach($employeeDailyRecords as $employeeDailyRecord){
			$dailyWorkedHours = $this->dailyWorkedHoursCalculator->calculate($employeeDailyRecord);
			$this->dailyWorkedHoursStack->add($employeeDailyRecord->employee->id, $dailyWorkedHours);
		}
	}
}