<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class PositionRepository extends Repository{

	public function model(){
		return 'App\Position';
	}

}