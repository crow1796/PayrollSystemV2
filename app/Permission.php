<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Permission extends Model implements SluggableInterface
{
	use SluggableTrait;

    protected $table = 'permissions';
    protected $fillable = [
    	'slug',
    	'name'
    ];
    protected $sluggable = [
    	'build_from' => 'name',
    	'save_to' => 'slug',
        'on_update' => true,
    ];
    protected $casts = [
        'slug' => 'string',
        'name' => 'string'
    ];

    public function users(){
    	return $this->hasMany('App\User', 'id');
    }
}
