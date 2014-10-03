<?php

class Job extends \Eloquent {

	protected $guarded = ['id'];

	/**
	 * Job belongs to author
	 * 
	 */
	public function author()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    /**
     * Job belongs to programs
     *
     */
    public function programs()
    {
        return $this->belongsToMany('Program');
    }

    /**
     * Job has many
     *
     */
    public function applications()
    {
        return $this->hasMany('Application');
    }


}