<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/1/2014
 * Time: 2:58 PM
 */

namespace job_board\Repositories;

use \Application;
use \ApplicationComment;

class ApplicationRepository {

    /**
     * Submit the job application
     *
     * @param $job
     * @param $user
     */
    public function submit ($job, $user, $input)
    {
        $application = new Application;
        $application->job_id = $job->id;
        $application->user_id = $user->id;
        $application->status_id = 1;
        $application->save();

        if($input['message'])
        {
            $app_comment = new ApplicationComment;
            $app_comment->body = $input['message'];
            $app_comment->application_id = $application->id;
            $app_comment->user_id = $user->id;
            $app_comment->save();
        }
    }

    /**
     * Get the specified application
     *
     * @param $app_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function get_application($app_id)
    {
        $app = Application::find($app_id);
        return $app;
    }

    /**
     * Delete the application and related comments
     * @param $app_id
     */
    public function delete_application($app_id)
    {
        $application = Application::find($app_id);
        $application->delete();
        ApplicationComment::where('application_id', '=', $app_id)->delete();
    }

    /**
     * Create a new application comment
     *
     * @param Form input   $input
     * @param Int   $app_id
     * @param Object   $user
     */
    public function create_app_comment($input, $app_id, $user)
    {
        $app_comment = new ApplicationComment;
        $app_comment->application_id = $app_id;
        $app_comment->user_id = $user->id;
        $app_comment->body = $input['application_comment'];
        $app_comment->save();
    }
} 