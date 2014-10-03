<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 9/26/2014
 * Time: 3:20 PM
 */

namespace controllers;


use job_board\Repositories\UserRepository;

class jb_controller extends \BaseController {

    protected $user;

    function __construct (UserRepository $user){
        $this->user = $user;
    }
} 