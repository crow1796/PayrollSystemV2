<?php

namespace App\Support\Payroll\Calculator;

use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Eloquent\EmployeeRepository;

class SalaryCalculator{

	protected $eventRepository;
	protected $employeeRepository;
	protected $employee;
	protected $rates;

	public function __construct(EventRepository $eventRepository, 
								EmployeeRepository $employeeRepository){
		$this->eventRepository = $eventRepository;
		$this->employeeRepository = $employeeRepository;
	}

	/**
	 * Calculate salary based on dailyWorkedHours of an employee(From cutoff_start to cutoff_end).
	 * @param  DailyWorkedHoursStack $dailyWorkedHoursStack 
	 * @return mixed                        
	 */
	public function calculate($dailyWorkedHoursStack){
		// Extract employe ID
		$employeeId = key($dailyWorkedHoursStack->all());
		// Find employee by the ID above
		$this->getEmployeeById($employeeId);

		foreach($dailyWorkedHoursStack->all()[$employeeId] as $dailyWorkedHours){
			$this->checkDate($dailyWorkedHours);
		}
	}

	protected function checkDate($dailyWorkedHours){
		$event = $this->eventRepository
						->where('start', '=', $dailyWorkedHours->recordDate());
		if($event->count() > 0){
			
		}
	}

	protected function getEmployeeById($id){
		$this->employee = $this->employeeRepository
								->findById($id);
		if($this->employee->rates->isEmpty()){
			$this->rates = $this->employee
								->department
								->rates[0];
			return false;
		}

		$this->rates = $this->employee->rates[0];
		return true;
	}
}