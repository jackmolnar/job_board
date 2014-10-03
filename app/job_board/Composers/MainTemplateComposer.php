<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 9/25/2014
 * Time: 10:58 AM
 */

namespace job_board\Composers;

use job_board\Repositories\UserRepository;


class MainTemplateComposer {

    protected $user;

    public function __construct (UserRepository $user){
        $this->user = $user;
    }

    public function compose($view)
    {
        $authed_user = $this->user->authed_user();
        $view->with('authed_user', $authed_user);
    }
} 