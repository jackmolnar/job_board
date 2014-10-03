<?php

class Application extends \Eloquent {
	protected $fillable = ['job_id', 'user_id', 'status_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * An Application belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * An application belongs to a job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo('Job');
    }

    /**
     * An application belongs to a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('ApplicationStatus');
    }

    /**
     * Application has many comments about it
     */
    public function comments()
    {
        return $this->hasMany('ApplicationComment');
    }



}