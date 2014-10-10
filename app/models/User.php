<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * Set fillable columns
	 */
	protected $fillable = ['email', 'password', 'first_name', 'last_name', 'role_id'];


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * User has User Details
     *
     */
    public function details()
    {
        return $this->hasOne('UserDetails');
    }

    /**
	 * User belong to a role
	 * 
	 */
	public function role()
    {
        return $this->belongsTo('Role');
    }

    /**
     * User is author of many jobs
     */
    public function jobs()
    {
        return $this->hasMany('Job');
    }

    /**
     * User belongs to many programs
     */
    public function programs()
    {
        return $this->belongsToMany('Program');
    }

    /**
     * User has applied for jobs
     */
    public function applications()
    {
        return $this->hasMany('Application');
    }

    /**
     * User is author of many comments
     */
    public function comments()
    {
        return $this->hasMany('ApplicationComment');
    }





    /**
     * Token functions
     */
    public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}


}
