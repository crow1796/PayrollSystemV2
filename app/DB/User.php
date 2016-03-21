<?php 
namespace App\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\Requests\Auth\RegisterRequest;
use App\DB\User\Traits\UserACL;
use App\DB\User\Traits\UserAccessors;
use App\DB\User\Traits\UserQueryScopes;
use App\DB\User\Traits\UserRelationShips;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * Application's Traits (Separation of various types of methods)
	 */
	use UserACL, UserRelationShips;

	protected $table = 'users';
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
        'role_id'
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

    public function role(){
        return $this->belongsTo('App\DB\Role', 'permission_id');
    }

    public function logs(){
        return $this->hasMany('\App\Log', 'id');
    }

    public function getFullnameAttribute(){
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->suffix;
    }
}