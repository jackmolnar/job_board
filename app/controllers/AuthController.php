<?php

use \job_board\Validators\AuthValidator;

class AuthController extends \BaseController {

	public $validator;

	public function __construct(AuthValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * process Auth request
	 * POST /auth
	 *
	 * @return Redirect
	 */
	public function postLogin()
	{
		//validate required input
		$valid = $this->validator->auth(Input::all());

		if($valid['status'])
		{
			if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
				return Redirect::action('UsersController@index');
			} else {
				return Redirect::back()->withErrors('Email or Password are incorrect.')->withInput();
			}
		}		

		return Redirect::back()->withErrors($valid['messages'])->withInput();
	}

	/**
	 * process logout request
	 * POST /auth
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

}

	