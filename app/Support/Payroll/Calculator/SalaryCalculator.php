<?php

namespace App\Support\Payroll\Calculator;

use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Support\Payroll\Wrapper\Salary;
use App\Support\Payroll\Stack\SalaryStack;

class SalaryCalculator implements \App\Support\Payroll\Calculator\Contracts\Deducter{
	use \App\Support\Payroll\Calculator\Traits\Deducter;

	protected $eventRepository;
	protected $employeeRepository;
	protected $employee;
	protected $rates;

	protected $workDays;
	protected $workHours;
	protected $workIncomes;
	protected $deductions;

	protected $event;
	protected $salaryStack;

	public function __construct(EventRepository $eventRepository, 
								EmployeeRepository $employeeRepository,
								SalaryStack $salaryStack){
		$this->eventRepository = $eventRepository;
		$this->employeeRepository = $employeeRepository;
		$this->salaryStack = $salaryStack;
		$this->reset();
	}

	/**
	 * Calculate salary based on dailyWorkedHours of an employee(From cutoff_start to cutoff_end).
	 * @param  DailyWorkedHoursStack $dailyWorkedHoursStack 
	 * @return mixed                        
	 */
	public function calculate($dailyWorkedHoursStack){
		foreach($dailyWorkedHoursStack->all() as $employeeId => $dailyWorkedHoursCollection){
			$this->reset();
			// Find employee by the ID above
			$this->getEmployeeById($employeeId);

			foreach($dailyWorkedHoursCollection as $dailyWorkedHours){
				$this->checkDate($dailyWorkedHours);
			}
			$this->salaryStack
				->add(new Salary($this->employee, $this->workDays, $this->workHours, $this->workIncomes, $this->deductions));
		}
		return $this->salaryStack;
	}

	protected function checkDate($dailyWorkedHours){
		$event = $this->eventRepository
						->where('start', '=', $dailyWorkedHours->recordDate());

		if($event->count() > 0){
			$this->event = $event[0];
			$this->calculateNoWorkLegal($dailyWorkedHours);
			$this->calculateLegalSunday($dailyWorkedHours, 'legal_sun');
			$this->calculateLegalHoliday($dailyWorkedHours, 'legal_holiday');
			$this->calculateSpecialHoliday($dailyWorkedHours, 'spl_holiday');
			return false;
		}

		$this->calculateSunday($dailyWorkedHours, 'sun');
		$this->calculateRegular($dailyWorkedHours, 'regular');
		return true;
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

	protected function calculateNoWorkLegal($dailyWorkedHours){
		if($this->event->eventType->name == 'No Work Legal Holiday'){
			$this->workDays['no_work_legal_holiday'] += 1;
			$this->workIncomes['no_work_legal_holiday'] += ($this->rates->no_work_legal_holiday * 1);
			return true;
		}
		return false;
	}

	protected function calculateLegalSunday($dailyWorkedHours, $attributeName){
		$attributeNameOt = $attributeName . '_ot';
		$attributeNameNd = $attributeName . '_nd';
		$attributeNameNdOt = $attributeName . '_nd_ot';

		if($this->event->eventType->name == 'Legal Sunday Workday'){
			$this->calculateIncome($dailyWorkedHours, 
									['regular' => $attributeName, 
									'overtime' => $attributeNameOt, 
									'nightDiff' => $attributeNameNd, 
									'nightDiffOvertime' => $attributeNameNdOt]);
			return true;
		}
		return false;
	}

	public function calculateLegalHoliday($dailyWorkedHours, $attributeName){
		$attributeNameOt = $attributeName . '_ot';
		$attributeNameNd = $attributeName . '_nd';
		$attributeNameNdOt = $attributeName . '_nd_ot';

		if($this->event->eventType->name == 'Legal Holiday Workday'){
			$this->calculateIncome($dailyWorkedHours, 
									['regular' => $attributeName, 
									'overtime' => $attributeNameOt, 
									'nightDiff' => $attributeNameNd, 
									'nightDiffOvertime' => $attributeNameNdOt]);
			return true;
		}
		return false;
	}

	public function calculateSpecialHoliday($dailyWorkedHours, $attributeName){
		$attributeNameOt = $attributeName . '_ot';
		$attributeNameNd = $attributeName . '_nd';
		$attributeNameNdOt = $attributeName . '_nd_ot';

		if($this->event->eventType->name == 'Special Holiday Workday'){
			$this->calculateIncome($dailyWorkedHours, 
									['regular' => $attributeName, 
									'overtime' => $attributeNameOt, 
									'nightDiff' => $attributeNameNd, 
									'nightDiffOvertime' => $attributeNameNdOt]);
			return true;
		}
		return false;
	}

	public function calculateSunday($dailyWorkedHours, $attributeName){
		$attributeNameOt = $attributeName . '_ot';
		$attributeNameNd = $attributeName . '_nd';
		$attributeNameNdOt = $attributeName . '_nd_ot';

		if($dailyWorkedHours->recordDate()->format('D') == 'Sun'){
			$this->calculateIncome($dailyWorkedHours, 
									['regular' => $attributeName, 
									'overtime' => $attributeNameOt, 
									'nightDiff' => $attributeNameNd, 
									'nightDiffOvertime' => $attributeNameNdOt]);
			return true;
		}
		return false;
	}

	public function calculateRegular($dailyWorkedHours, $attributeName){
		$attributeNameOt = $attributeName . '_ot';
		$attributeNameNd = $attributeName . '_nd';
		$attributeNameNdOt = $attributeName . '_nd_ot';

		if($dailyWorkedHours->recordDate()->format('D') != 'Sun'){
			$this->calculateIncome($dailyWorkedHours, 
									['regular' => $attributeName, 
									'overtime' => $attributeNameOt, 
									'nightDiff' => $attributeNameNd, 
									'nightDiffOvertime' => $attributeNameNdOt]);
			return true;
		}
		return false;
	}

	protected function calculateIncome($dailyWorkedHours, $attributes){
		$this->workDays[$attributes['regular']] += ($dailyWorkedHours->regularHours() / 8);

		if($dailyWorkedHours->shift() == 1){
			$this->workHours[$attributes['regular']] += ($dailyWorkedHours->regularHours());
			$this->workHours[$attributes['overtime']] += ($dailyWorkedHours->overtimeHours());
			$this->workIncomes[$attributes['regular']] += ($this->rates->{$attributes['regular']} * $dailyWorkedHours->regularHours());
			$this->workIncomes[$attributes['overtime']] += ($this->rates->{$attributes['overtime']} * $dailyWorkedHours->overtimeHours());
		}

		if($dailyWorkedHours->shift() == 2){
			$this->workHours[$attributes['nightDiff']] += ($dailyWorkedHours->regularHours());
			$this->workHours[$attributes['nightDiffOvertime']] += ($dailyWorkedHours->overtimeHours());
			$this->workIncomes[$attributes['nightDiff']] += ($this->rates->{$attributes['nightDiff']} * $dailyWorkedHours->regularHours());
			$this->workIncomes[$attributes['nightDiffOvertime']] += ($this->rates->{$attributes['nightDiffOvertime']} * $dailyWorkedHours->overtimeHours());
		}
	}

	protected function reset(){
		$this->workDays = [
			'regular' => 0,
			'sun' => 0,
			'spl_holiday' => 0,
			'legal_holiday' => 0,
			'legal_sun' => 0,
			'no_work_legal_holiday' => 0,
		];
		$this->workHours = [
			'regular' => 0,
			'regular_ot' => 0,
			'regular_nd' => 0,
			'regular_nd_ot' => 0,
			'sun' => 0,
			'sun_ot' => 0,
			'sun_nd' => 0,
			'sun_nd_ot' => 0,
			'spl_holiday' => 0,
			'spl_holiday_ot' => 0,
			'spl_holiday_nd' => 0,
			'spl_holiday_nd_ot' => 0,
			'legal_holiday' => 0,
			'legal_holiday_ot' => 0,
			'legal_holiday_nd' => 0,
			'legal_holiday_nd_ot' => 0,
			'legal_sun' => 0,
			'legal_sun_ot' => 0,
			'legal_sun_nd' => 0,
			'legal_sun_nd_ot' => 0,
		];
		$this->workIncomes = [
			'regular' => 0,
			'regular_ot' => 0,
			'regular_nd' => 0,
			'regular_nd_ot' => 0,
			'sun' => 0,
			'sun_ot' => 0,
			'sun_nd' => 0,
			'sun_nd_ot' => 0,
			'spl_holiday' => 0,
			'spl_holiday_ot' => 0,
			'spl_holiday_nd' => 0,
			'spl_holiday_nd_ot' => 0,
			'legal_holiday' => 0,
			'legal_holiday_ot' => 0,
			'legal_holiday_nd' => 0,
			'legal_holiday_nd_ot' => 0,
			'legal_sun' => 0,
			'legal_sun_ot' => 0,
			'legal_sun_nd' => 0,
			'legal_sun_nd_ot' => 0,
			'no_work_legal_holiday' => 0,
		];

		$this->deductions['expenses'] = [
			'coop_share_capital' => 0,
			'contributions' => [
				'sss' => 0,
				'pagibig' => 0,
				'philhealth' => 0,
			],
			'loans' => [
				'sss' => 0,
				'pagibig' => 0,
				'emergency' => 0,
			]
		];

		$this->deductions['investments'] = [
			'investment_1' => 0,
			'investment_2' => 0,
			'investment_3' => 0,
			'investment_4' => 0,
			'investment_5' => 0,
			'investment_6' => 0,
			'investment_7' => 0,
		];
	}
}