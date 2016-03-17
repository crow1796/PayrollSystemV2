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
		$employee = $salary->employee();
		$employeeExpenses = $employee->expenses;
		$employeeInvestments = $employee->investments;

		$this->deductions['expenses'] = [
			'coop_share_capital' => $employeeExpenses[0]->pivot->deduction,
			'contributions' => [
				'sss' => $employeeExpenses[1]->pivot->deduction,
				'pagibig' => $employeeExpenses[2]->pivot->deduction,
				'philhealth' => $employeeExpenses[3]->pivot->deduction,
			],
			'loans' => [
				'sss' => $employeeExpenses[4]->pivot->deduction,
				'pagibig' => $employeeExpenses[5]->pivot->deduction,
				'emergency' => $employeeExpenses[6]->pivot->deduction,
			]
		];

		$this->deductions['investments'] = [
			'investment_1' => $employeeInvestments[0]->pivot->deduction,
			'investment_2' => $employeeInvestments[1]->pivot->deduction,
			'investment_3' => $employeeInvestments[2]->pivot->deduction,
			'investment_4' => $employeeInvestments[3]->pivot->deduction,
			'investment_5' => $employeeInvestments[4]->pivot->deduction,
			'investment_6' => $employeeInvestments[5]->pivot->deduction,
			'investment_7' => $employeeInvestments[6]->pivot->deduction,
		];

		$salary->setDeductions($this->deductions);
	}
}