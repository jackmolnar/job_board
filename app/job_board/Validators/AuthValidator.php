<?php namespace job_board\Validators;

use Validator;

class AuthValidator {

	/**
	 * validation rules for authing in
	 */
	protected $rules = array(
			'email' => 'required',
			'password' => 'required'
		);

	/**
	 * Validate the create user input
	 * @param mixed
	 * @return array [status => true or false, messages => errors or success]
	 */
	public function auth($input){

		$validator = Validator::make($input, $this->rules);

		if ($validator->fails()){
			$result['status'] = false;
			$result['messages'] = $validator->errors();
			return $result;
		}

		$result['status'] = true;
		$result['messages'] = 'Login Successful';
		return $result;
	}


}