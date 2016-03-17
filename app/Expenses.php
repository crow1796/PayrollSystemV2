<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
    	'name'
    ];

    public function employees(){
    	return belongsToMany('\App\Employee', 'employee_expenses', 'employee_id', 'expenses_id');
    }
}
