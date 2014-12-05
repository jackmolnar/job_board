<?php
use job_board\Helpers\StatusHelpers;
use job_board\Repositories\ApplicationRepository;
use job_board\Repositories\JobRepository;
use job_board\Repositories\UserRepository;

/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/2/2014
 * Time: 1:33 PM
 */

class ApplicationStatusController extends \BaseController
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
    /**
     * @var StatusHelpers
     */
    private $status_helpers;

    function __construct(ApplicationRepository $application, StatusHelpers $status_helpers)
    {
        $this->beforeFilter('auth');

        $this->application = $application;
        $this->status_helpers = $status_helpers;
    }


    /**
     * Store a newly created job application
     * POST /jobs/{$job_id}/applications/
     * @param int $job_id
     * @return Response
     */
    public function store($job_id, $app_id)
    {
        $app = $this->application->get_application($app_id);
        $status = Input::all();
        $app->status_id = $status['status'];
        $app->save();

        return Redirect::action('ApplicationsController@show', [$job_id, $app_id])->with('success', 'Status Changed');
    }



}

