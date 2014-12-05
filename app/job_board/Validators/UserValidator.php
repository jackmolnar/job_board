<?php namespace job_board\Validators;

use Illuminate\Support\Facades\File;
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

	/**
	 * validation rules for creating new graduate
	 */
	protected $create_grad_rules = array(
        'email'         => 'required|unique:users|email',
        'first_name'    => 'required',
        'last_name'     => 'required'
    );

	/**
	 * validation rules for creating new employment specialist
	 */
	protected $create_emp_specialist_rules = array(
        'email'         => 'required|unique:users|email',
        'password'      => 'required|min:6',
        'first_name'    => 'required',
        'last_name'     => 'required'
    );

	/**
	 * validation rules for creating new employment specialist
	 */
	protected $create_administrator_rules = array(
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

    protected $excel_rules = array(
        'user_import'    => 'required|mimes:xls,xlsx|max:3000'
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
	 * Validate the graduate input
	 * @param $input array
	 * @return mixed
	 */
	public function create_graduate($input){

		$validator = Validator::make($input, $this->create_grad_rules);
		$result = parent::get_messages($validator, 'New Graduate Created.');

        return $result;
	}

    /**
	 * Validate the employment specialist
	 * @param $input array
	 * @return mixed
	 */
	public function create_emp_specialist($input){

		$validator = Validator::make($input, $this->create_emp_specialist_rules);
		$result = parent::get_messages($validator, 'New Employment Specialist Created.');

        return $result;
	}

    /**
	 * Validate the employment specialist
	 * @param $input array
	 * @return mixed
	 */
	public function create_administrator($input){

		$validator = Validator::make($input, $this->create_administrator_rules);
		$result = parent::get_messages($validator, 'New Administrator Created.');

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

    /**
     * Validate resume input
     * @param $input
     * @return mixed
     */
    public function upload_resume($input)
    {
        $validator = Validator::make($input, $this->resume_rules);
        $result = parent::get_messages($validator, 'Resume Successfully Uploaded.');
        return $result;
    }

    public function upload_excel($input)
    {
        $validator = Validator::make($input, $this->excel_rules);
        $result = parent::get_messages($validator, 'File Uploaded');
        return $result;
    }


}