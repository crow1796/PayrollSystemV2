<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquents\Repository;

class DepartmentRepository extends Repository{
	public function model(){
		return 'App\Department';
	}
}