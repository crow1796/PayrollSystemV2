<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTransaction extends Model
{
    protected $table = 'payrolltransactions';
    protected $fillable = [
    	'cutoff_start',
    	'cutoff_end',
    	'cutoff',
    ];
    protected $dates = [
    	'cutoff_start',
    	'cutoff_end',
    ];
}
