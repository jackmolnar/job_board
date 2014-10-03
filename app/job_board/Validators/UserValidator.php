<?php namespace job_board\Validators;

use Validator;

class UserValidator extends jb_validator{

	/**
	 * validation rules for creating new user
	 */
	protected $create_rules = array(
        'email'         => 'required|unique:users|email',
        'password'      => 'required|min:6',
        'first_name'    => 'required',
        'last_name'     => 'required'
    );

    protected $update_rules = array(
        'email'         => 'required|email',
        'first_name'    => 'required',
        'last_name'     => 'required',
        'phone'         => 'min:10|max:12',
        'zip'           => 'max:10',
        'state'         => 'size:2'

    );

    protected $resume_rules = array(
        'resume'    => 'required|mimes:pdf,doc,docx|max:3000'
    );

	/**
	 * Validate the create user input
	 * @param $input array
	 * @return mixed
	 */
	public function create($input){

		$validator = Validator::make($input, $this->create_rules);
		$result = parent::get_messages($validator, 'User Successfully Created.');

        return $result;
	}

    /**
     * Validate update input
     * @param $input array
     * @return mixed
     */
    public function update($input){

        $validator = Validator::make($input, $this->update_rules);
        $result = parent::get_messages($validator, 'Profile Successfully Updated.');

        return $result;
    }

    public function upload_resume($input)
    {
        $validator = Validator::make($input, $this->resume_rules);
        $result = parent::get_messages($validator, 'Resume Successfully Uploaded.');
        return $result;

    }


}