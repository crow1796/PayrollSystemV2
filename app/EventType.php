<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class EventType extends Model implements SluggableInterface
{
	use SluggableTrait;
    protected $table = 'event_types';
    protected $fillable = [
    	'name',
    	'slug'
    ];
    protected $sluggable = [
    	'build_from' => 'name',
    	'save_to' => 'slug',
        'on_update' => true
    ];
    protected $casts = [
    	'name' => 'string',
    	'slug' => 'string',
        'class_value' => 'string'
    ];

    public function events(){
    	return $this->hasMany('\App\Event', 'id');
    }
}
