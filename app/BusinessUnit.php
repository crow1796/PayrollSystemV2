<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class BusinessUnit extends Model implements SluggableInterface
{
	use SluggableTrait;
    protected $table = 'business_units';
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
        'slug' => 'string'
    ];
    
    public function employees(){
    	return $this->hasMany('\App\Employee', 'id');
    }
}
