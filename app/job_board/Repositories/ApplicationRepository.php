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
use \job_board\Validators\AppCommentValidator;

class ApplicationRepository {

    protected $validator;

    /**
     * Constructor
     *
     * @param AppCommentValidator $validator
     */

    public function __construct( AppCommentValidator $validator)
    {
        $this->validator = $validator;
    }

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
        $app = Application::with(array('comments' => function($query)
        {
            $query->orderBy('created_at', 'asc');
        }, 'user'))->where('id', '=', $app_id)->first();

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
     * @param Form mixed   $input
     * @param Int   $app_id
     * @param Object   $user
     * @return Array  $valid
     */
    public function create_app_comment($input, $app_id, $user)
    {
        $valid = $this->validator->create($input);

        if($valid['status'])
        {
            $app_comment = new ApplicationComment;
            $app_comment->application_id = $app_id;
            $app_comment->user_id = $user->id;
            $app_comment->body = $input['application_comment'];
            $app_comment->save();
        }

        return $valid;
    }

    public function delete_app_comment($comment_id)
    {
        $app_comment = ApplicationComment::find($comment_id);
        $app_comment->delete();
    }
} 