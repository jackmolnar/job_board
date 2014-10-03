<?php

class Program extends \Eloquent {
    protected $fillable = ['title', 'name', 'school_id', 'active'];

    protected $table = 'programs';

    /**
     * programs belong to many users
     */
    public function users()
    {
        return $this->belongsToMany('User');
    }

    /**
     * programs belong to many jobs
     */
    public function jobs()
    {
        return $this->belongsToMany('Job');
    }

    /**
     * Get and format roles as array usable by blade.
     * @return array
     */
    public static function returnDropdownArray()
    {
        $programs = Program::where('active', '=', 1)->get(['id', 'title']);

        $data = array();

        foreach ($programs as $program) {
            $data[$program->id] = $program->title;
        }

        return $data;
    }


}

