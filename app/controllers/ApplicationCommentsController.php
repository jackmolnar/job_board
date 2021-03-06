<?php

use \job_board\Repositories\ApplicationRepository;
use job_board\Repositories\UserRepository;

class ApplicationCommentsController extends \BaseController {

    protected $application;
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(ApplicationRepository $application, UserRepository $user)
    {
        $this->application = $application;
        $this->user = $user;
    }


    /**
	 * Display a listing of the resource.
	 * GET /applicationcomments
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /applicationcomments/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /applicationcomments
	 *
	 * @return Response
	 */
	public function store($job_id, $app_id)
	{
		$result = $this->application->create_app_comment(Input::all(), $app_id, $this->user->authed_user());

        if(!$result['status']) {
            return Redirect::back()->withInput()->withErrors($result['messages']);
        } else {
            return Redirect::action('ApplicationsController@show', [$job_id, $app_id])->with('success', $result['messages']);
        }

	}

	/**
	 * Display the specified resource.
	 * GET /applicationcomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /applicationcomments/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /applicationcomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /applicationcomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($job_id, $app_id, $comment_id)
	{
        $this->application->delete_app_comment($comment_id);
        return Redirect::action('ApplicationsController@show', [$job_id, $app_id])->with('success', 'Comment Deleted.');
	}

}