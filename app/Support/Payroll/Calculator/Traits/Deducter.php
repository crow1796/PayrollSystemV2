<?php

namespace App\Support\Payroll\Calculator\Traits;

trait Deducter {
	/**
	 * Deduct all salaries from salarystack.
	 * @return mixed 
	 */
	public function deduct(){
		$salaries = $this->salaryStack->all();
		array_walk($salaries, [$this, 'iterateDeduct']);
	}

	protected function iterateDeduct($salary){
		dd($salary->employee());
	}
}