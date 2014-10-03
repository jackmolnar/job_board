<?php namespace job_board\Validators;

use Validator;

class JobValidator extends jb_validator {

	/**
	 * validation rules for creating new user
	 */
	protected $create_rules = array(
			'title' => 'required',
			'description' => 'required',
			'company_name' => 'required',
			'company_address' => 'required',
			'company_city' => 'required',
			'company_state' => 'required'
		);


	/**
	 * Validate the create job input
	 * @param mixed
	 * @return array [status => true or false, messages => errors or success]
	 */
	public function create($input){

		$validator = Validator::make($input, $this->create_rules);

        $result = parent::get_messages($validator, 'Job successfully posted.');

		return $result;
	}

	/**
	 * Validate the create job input
	 * @param mixed
	 * @return array [status => true or false, messages => errors or success]
	 */
	public function update($input){

		$validator = Validator::make($input, $this->create_rules);

        $result = parent::get_messages($validator, 'Job successfully updated.');

        return $result;
	}

}