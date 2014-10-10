<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/6/2014
 * Time: 2:49 PM
 */

namespace job_board\Repositories;

use User;

class GradRepository {

    /**
     * @var UserRepository
     */
    private $user;

    function __construct(UserRepository $user)
    {

        $this->user = $user;
    }


    /**
     * Get all grads
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        $all = User::with(['details', 'programs'])->whereHas('role', function($query)
        {
            $query->where('title', '=', 'Graduate');
        })->get();

        return $all;
    }

    public function all_users_grads($user)
    {
        //get the users programs
        $programs = $user->programs;

        //set up the array
        $users_grad_list = array();

        //for each program, push grads into array
        foreach($programs as $program){
            $users_grad_list[$program->title] = User::with(['details', 'programs'])->whereHas('role', function($query)
                    {
                        $query->where('title', '=', 'Graduate');
                    })->whereHas('programs', function($query) use ($program)
                    {
                        $query->where('programs.id', '=', $program->id);
                    })->get();
        }

        return $users_grad_list;

        //works for one program
//        $grads = $user->programs()->first()->users;
//        foreach($grads as $k => $grad){
//            if($grad->role->title != "Graduate"){
//                unset($grads[$k]);
//            }
//        }


        //select all users that have a role of graduate and whose program matches the authenticated users programs

//        $grads = User::with(['details', 'programs'])->whereHas('role', function($query)
//        {
//            $query->where('title', '=', 'Graduate');
//        })->whereHas('programs', function($query) use ($user)
//        {
//            $query->where('programs', '=', $user->programs);
//        })->get();

//        $grads = User::with(['details', 'programs'])->whereHas('role', function($query)
//        {
//            $query->where('title', '=', 'Graduate');
//        })->whereHas('programs', function($query) use ($user_id)
//        {
//            $query->where('programs', '=', $user_id);
//        })->get();


    }

}
