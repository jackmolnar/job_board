<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/6/2014
 * Time: 12:08 PM
 */

namespace job_board\Helpers;


class StatusHelpers {

    /**
     * If app was sent and viewed by admin, move status of app to in review
     *
     * @param $application
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function admin_first_review($application, $user)
    {
        if($application->status->title == 'Sent' && $user->role->title == 'Administrator'){
            $application = \Application::find($application->id);
            $application->status_id = '2';
            $application->save();
            return $application;
        }
        return $application;
    }

} 