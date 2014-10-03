<?php

class Role extends \Eloquent {
	protected $fillable = ['name', 'title'];

	protected $table = 'roles';

	/**
	 * many users belong to the roles
	 */
    public function users()
    {
        return $this->hasMany('User');
    }

    /**
     * Get and format roles as array usable by blade.
     * @return array 
     */
    public static function returnDropdownArray()
    {
		$roles = Role::get(['id', 'title']);

		$data = array();

		foreach ($roles as $role) {
			$data[$role->id] = $role->title;
		}

		return $data;
    }


}