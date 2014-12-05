<?php

use job_board\Mailers\GradMailer;
use job_board\Repositories\GradRepository;
use \job_board\Repositories\UserRepository;

class UsersController extends \BaseController {

	protected $user;
    /**
     * @var GradRepository
     */
    private $grads;

    /**
     * @var GradMailer
     */
    private $gradMailer;

    function __construct(UserRepository $user, GradRepository $grads, GradMailer $gradMailer)
	{
		$this->beforeFilter('auth', ['except' => ['create', 'store', 'destroy'] ]);

		$this->user = $user;
        $this->grads = $grads;
        $this->gradMailer = $gradMailer;
    }

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$authed_user = $this->user->authed_user();

        $job_applications = $this->user->job_apps($authed_user);

		return View::make('users.index', ['user' => $authed_user, 'job_apps' => $job_applications]);
	}


    public function all()
    {
        $user = $this->user->authed_user();

        if($user->role->title == 'Administrator'){
            $grads = $this->grads->all();
        } else if ($user->role->title == 'Employment Specialist'){
            $grads = $this->grads->all_users_grads($user);
        }

        return View::make('users.all', ['grads' => $grads]);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//get the role array suitable for blade dropdown
		$dropdownArray = Role::returnDropdownArray();
        //get program array suitable for blade dropdown
        $program_dropdownArray = Program::returnDropdownArray();
		return View::make('users.create', ['roles' => $dropdownArray, 'programs' => $program_dropdownArray]);
	}
    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        //attempt to create the user
        $result = $this->user->create(Input::all());

        //if status not true, go back
        if(!$result['status']){
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::to('/')->with('success', $result['messages']);
        }
    }


    /**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function manual_create()
	{
        //get program array suitable for blade dropdown
        $program_dropdownArray = Program::returnDropdownArray();
		return View::make('users.manual_create', ['programs' => $program_dropdownArray]);
	}
    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function manual_store()
    {
        //attempt to create the user
        $result = $this->user->create(Input::all(), 3);

        //if status not true, go back
        if(!$result['status']){
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::to('/users')->with('success', 'New Graduate Created.');
        }
    }


    /**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function import_create()
	{
		return View::make('users.import_create');
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function import_store()
	{
		//attempt to create the user
        $result = $this->user->upload_excel_file(Input::file());

		//if status not true, go back
		if(!$result['status']){
			return Redirect::back()->withInput()->withErrors($result['messages']);
		} else {
			return Redirect::back()->with('success', $result['messages']);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->get_user($id);

        return View::make('users.show', ['user' => $user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = $this->user->get_user($id);

        //get or create user details
        $user_details = ($user->details == NULL) ? $this->user->create_user_details($id) : $user->details;

        $dropdownArray = Program::returnDropdownArray();

        return View::make('users.edit', ['user' => $user, 'user_details' => $user_details, 'all_programs' => $dropdownArray]);
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $result = $this->user->update(Input::all(), $id);

        if(!$result['status']){
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::action('UsersController@show', $id)->with('success', $result['messages']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function getUpdateGrad($id)
    {
        $user = $this->user->get_user($id);

        //get or create user details
        $user_details = ($user->details == NULL) ? $this->user->create_user_details($id) : $user->details;

        $dropdownArray = Program::returnDropdownArray();

        return View::make('users.edit_grad', ['user' => $user, 'user_details' => $user_details, 'all_programs' => $dropdownArray]);
    }

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdateGrad($id)
	{
        $result = $this->user->update(Input::all(), $id);

        if(!$result['status']){
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::action('UsersController@show', $id)->with('success', $result['messages']);
        }
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Get Resume Upload View
     *
     * @param int $id
     * @return Response
     */
    public function getResume($id)
    {
        return View::make('users.resume', ['id' => $id]);
    }

    /**
     * Upload the new Resume
     *
     * @param int $id
     * @return Response
     */
    public function postResume($id)
    {
        $result = $this->user->upload_resume(Input::file(), $id);

        if(!$result['status']){
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::action('UsersController@show', $id)->with('success', $result['messages']);
        }
    }


}