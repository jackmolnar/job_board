<?php

class ApplicationComment extends \Eloquent {
	protected $fillable = ['application_id', 'user_id', 'body'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_comments';

    /**
     * Comments belong to author
     *
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    /**
     * Comments belong to application
     *
     */
    public function application()
    {
        return $this->belongsTo('Application');
    }


}