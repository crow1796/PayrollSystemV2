<?php

namespace App\Support\Payroll\Calculator;

use App\Support\Payroll\Wrapper\DailyWorkedHours;

class DailyWorkedHoursCalculator {

	protected $calculatedHours;
	protected $regularHours;
	protected $undertimeHours;
	protected $overtimeHours;
	protected $totalHours;

	public function calculate($dailyRecord){
		$this->resetHours();

		$timeIn = $dailyRecord->time_in;
		$timeOut = $dailyRecord->time_out;

		$this->calculatedHours = ($timeIn > $timeOut) ? (($timeOut + 2400) - $timeIn) : ($timeOut - $timeIn);
		$this->regularHours = $this->calculatedHours;

		$this->calculateHours();
		
		$this->convertHoursToDecimal();

		return (new DailyWorkedHours(
					['regularHours' => $this->regularHours,
						'undertimeHours' => $this->undertimeHours, 
						'overtimeHours' => $this->overtimeHours, 
						'totalHours' => $this->totalHours,
						'record_date' => $dailyRecord->record_date]
				));
	}

	protected function calculateHours(){
		$this->calculateRegularHours();
		$this->calculateUndertimeHours();
		$this->calculateOvertimeHours();
		$this->calculateTotalHours();
	}

	protected function calculateRegularHours(){
		if($this->calculatedHours >= 800){
		    $this->regularHours = 800;
		}
	}

	protected function calculateUndertimeHours(){
		if($this->regularHours < 800){
		    $this->undertimeHours = 800 - $this->regularHours;
		}
	}

	protected function calculateOvertimeHours(){
		if($this->calculatedHours > 900){
		    $this->overtimeHours = ($this->calculatedHours - $this->regularHours) - 100;
		}
	}

	protected function calculateTotalHours(){
		$this->totalHours = ($this->regularHours + $this->overtimeHours);
	}

	protected function convertHoursToDecimal(){
		$this->regularHours /= 100;
		$this->undertimeHours /= 100;
		$this->overtimeHours /= 100;
		$this->totalHours /= 100;
	}

	protected function resetHours(){
		$this->regularHours = 0;
		$this->undertimeHours = 0;
		$this->overtimeHours = 0;
		$this->totalHours = 0;
	}
}