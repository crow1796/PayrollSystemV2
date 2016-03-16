<?php

namespace App\Support\Payroll\Wrapper;

class DailyWorkedHours {
	protected $workedHours;

	public function __construct($workedHours = null){
		if(is_null($workedHours)){
			return false;
		}

		$this->workedHours = $workedHours;
	}

	public function regularHours(){
		return $this->workedHours['regularHours'];
	}

	public function undertimeHours(){
		return $this->workedHours['undertimeHours'];
	}

	public function overtimeHours(){
		return $this->workedHours['overtimeHours'];
	}

	public function totalHours(){
		return $this->workedHours['totalHours'];
	}

	public function recordDate(){
		return $this->workedHours['record_date'];
	}

	public function shift(){
		return $this->workedHours['shift'];
	}
}