<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Event extends Model implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'events';
    protected $fillable = [
    	'title',
    	'allDay',
    	'start',
    	'end',
    	'className',
        'description',
        'event_type_id',
        'location'
    ];
    protected $dates = [
    	'start',
    	'end',
    	'created_at',
    	'updated_at'
    ];
    protected $casts = [
    	'className' => 'string',
    	'title' => 'string',
    	'allDay' => 'boolean'
    ];
    protected $sluggable = [
        'build_from' => 'title_and_year',
        'save_to' => 'slug',
        'on_update' => true
    ];

    public function eventType(){
        return $this->belongsTo('\App\EventType', 'event_type_id');
    }

    public function getTitleAndYearAttribute(){
        return $this->title . ' ' . \Carbon\Carbon::parse($this->start)->format('Y');
    }
}
