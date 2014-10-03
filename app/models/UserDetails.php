<?php

class UserDetails extends \Eloquent {
	protected $fillable = ['phone', 'text', 'street1', 'street2', 'city', 'state', 'zip', 'user_id', 'resume'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_details';

    /**
     * User Details belong to a user
     *
     */
    public function user()
    {
        return $this->belongsTo('User');
    }


}