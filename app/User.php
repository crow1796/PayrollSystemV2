<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class User extends Authenticatable implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'bmpc_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'firstname', 
        'middlename', 
        'lastname', 
        'email', 
        'password',
        'permission_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $sluggable = [
        'build_from' => 'username',
        'save_to' => 'slug',
        'on_update' => true
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'slug' => 'string',
        'username' => 'string'
    ];

    public function employmentInformation(){
        return $this->belongsTo('App\Employee', 'username');
    }

    public function permission(){
        return $this->belongsTo('App\Permission', 'permission_id');
    }

    public function logs(){
        return $this->hasMany('\App\Log', 'id');
    }

    public function getFullnameAttribute(){
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->suffix;
    }
}
