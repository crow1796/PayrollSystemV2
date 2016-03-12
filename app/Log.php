<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
    	'user_id',
    	'last_login'
    ];
    public $timestamps = false;
    protected $dates = [
    	'last_login'
    ];

    public function user(){
    	return $this->belongsTo('\App\User', 'user_id');
    }
}
