<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Benefit extends Model implements SluggableInterface
{
	use SluggableTrait;

    protected $table = 'benefits';
    protected $fillable = [
    	'name'
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $sluggable = [
    	'build_from' => 'name',
    	'save_to' => 'slug',
        'on_update' => true
    ];
    protected $casts = [
        'employee_id' => 'string',
        'benefits.pivot.benefit_id_value' => 'string',
        'slug' => 'string'
    ];

    public function employees(){
    	return $this->belongsToMany('\App\Employee', 'employee_benefit', 'benefit_id', 'employee_id');
    }
}
