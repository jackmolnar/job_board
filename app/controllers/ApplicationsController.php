<?php
use job_board\Repositories\ApplicationRepository;
use job_board\Repositories\JobRepository;
use job_board\Repositories\UserRepository;

/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/2/2014
 * Time: 1:33 PM
 */

class ApplicationsController extends \BaseController
{

    /**
     * @var JobRepository
     */
    private $job;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var ApplicationRepository
     */
    private $application;

    function __construct(UserRepository $user, JobRepository $job, ApplicationRepository $application)
    {
        $this->beforeFilter('auth');

        $this->job = $job;
        $this->user = $user;
        $this->application = $application;
    }

    /**
     * Show the form for creating a new application.
     * GET /jobs/{$job_id}/applications/create
     * @param int $job_id
     * @return Response
     */
    public function create($job_id)
    {
        $job = $this->job->get_job($job_id);
        $user = $this->user->authed_user();
        return View::make('applications.create', ['user' => $user, 'job' => $job]);
    }

    /**
     * Store a newly created job application
     * POST /jobs/{$job_id}/applications/
     * @param int $job_id
     * @return Response
     */
    public function store($job_id)
    {
        $job = $this->job->get_job($job_id);
        $user = $this->user->authed_user();
        $this->application->submit($job, $user, Input::all());

        return Redirect::action('JobsController@show', $job_id)->with('success', 'Application Sent.');
    }

    /**
     * Show the application
     * GET /jobs/{$job_id}/applications/{$app_id}
     * @param int $job_id
     * @param int $app_id
     * @return Response
     */
    public function show($job_id, $app_id)
    {
        $job = $this->job->get_job($job_id);
        $user = $this->user->authed_user();
        $application = $this->application->get_application($app_id);

        return View::make('applications.show', ['job' => $job, 'user' => $user, 'application' => $application]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /jobs/{$job_id}/applications/{$app_id}
     *
     * @param  int  $job_id
     * @param  int  $app_id
     * @return Response
     */
    public function destroy($job_id, $app_id)
    {
        $this->application->delete_application($app_id);
        return Redirect::action('JobsController@show', [$job_id])->with('success', 'Application Withdrawn.');
    }



}

