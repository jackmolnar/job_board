<?php

use \job_board\Repositories\JobRepository;
use \job_board\Repositories\UserRepository;
use job_board\Repositories\ApplicationRepository;

class JobsController extends \BaseController {

	protected $job;
    protected $user;
    protected $application;

	function __construct(JobRepository $job, UserRepository $user, ApplicationRepository $application)
	{
		$this->beforeFilter('auth');
		$this->job = $job;
        $this->user = $user;
        $this->application = $application;

	}
    /**
	 * Display a listing of the jobs created by the user
	 * GET /jobs
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
        $role = $user->role;
		$jobs = $this->job->get_authors_jobs($user['id']);

		return View::make('jobs.index', ['user' => $user, 'jobs' => $jobs]);
	}

    /**
     * Gell All Jobs.
     * If User is a Grad, get jobs to apply for related to program
     *      if user is administrator, get jobs they created
     *
     * GET /jobs
     *
     * @return Response
     */
    public function all()
    {
        $user = $this->user->authed_user();
        if($user->role->title == 'Graduate'){
            $jobs = $this->job->get_grads_jobs($user);
        } else if ($user->role->title == 'Administrator'){
            $jobs = $this->job->get_authors_jobs($user['id']);
        }

        return View::make('jobs.all', ['user' => $user, 'jobs' => $jobs]);
    }

	/**
	 * Show the form for creating a new job
	 * GET /jobs/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $dropdownArray = Program::returnDropdownArray();
		return View::make('jobs.create', ['programs' => $dropdownArray]);
	}

	/**
	 * Store a newly created job
	 * POST /jobs
	 *
	 * @return Response
	 */
	public function store()
	{
		$result = $this->job->create(Input::all());

		//if status not true, go back
		if(!$result['status']){
			return Redirect::back()->withInput()->withErrors($result['messages']);
		} else {
			return Redirect::action('JobsController@index')->with('success', $result['messages']);
		}
	}

	/**
	 * Display the selected job
	 * GET /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$result = $this->job->get_job($id);
        $user = $this->user->authed_user();
        //return $user->role;
        //dd($result->applications->first()->user);
        return View::make('jobs.show', ['job' => $result, 'user' => $user ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /jobs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$result = $this->job->get_job($id);
        $dropdownArray = Program::returnDropdownArray();
        //return $result;
        return View::make('jobs.edit', [ 'job' => $result, 'programs' => $dropdownArray ]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$result = $this->job->update(Input::all(), $id);

		//if status not true, go back
		if(!$result['status']){
			return Redirect::back()->withInput()->withErrors($result['messages']);
		} else {
			return Redirect::action('JobsController@index')->with('success', $result['messages']);
		}

	}

	/**
	 * Remove the specified job
	 * DELETE /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $result = $this->job->delete($id);
        return Redirect::action('JobsController@index')->with('success', $result['messages']);
	}


}