<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/29/2014
 * Time: 4:09 PM
 */

namespace job_board\Mailers;

use Illuminate\Auth\Reminders\ReminderRepositoryInterface;
use Illuminate\Mail\Mailer;

class GradMailer
{

    protected $reminders;

    function __construct(ReminderRepositoryInterface $reminders)
    {
        $this->reminders = $reminders;
    }

    public function sendNewGradInvite($user)
    {
        if($user->role->title == 'Graduate')
        {
            $token = $this->reminders->create($user);
            \Mail::send('emails.grads.invite', ['user' => $user, 'token' => $token], function ($message) use ($user) {
                $message->to($user->email, $user->first_name.' '.$user->last_name)->subject('TheCareerSchools Job Board Invitation');
            });
        }
    }

}