<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $table = 'investments';
    protected $fillable = [
    	'name'
    ];

    public function employees(){
    	return belongsToMany('\App\Employee', 'employee_investment', 'employee_id', 'investment_id');
    }
}
