<?php

class ApplicationStatus extends \Eloquent {
	protected $fillable = ['name', 'title'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_status';

    /**
     * Status belongs to applications
     *
     */
    public function application()
    {
        return $this->belongsTo('Application');
    }


}