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

    /**
     * Get and format statuses as array usable by blade.
     * @return array
     */
    public static function returnDropdownArray()
    {
        $statuses = ApplicationStatus::get();

        $data = array();

        foreach ($statuses as $status) {
            $data[$status->id] = $status->title;
        }

        return $data;
    }



}