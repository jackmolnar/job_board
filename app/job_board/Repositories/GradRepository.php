<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/6/2014
 * Time: 2:49 PM
 */

namespace job_board\Repositories;

use Illuminate\Database\Eloquent\Collection;
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

        //set up the collection
        $users_grad_list = new Collection;

        //for each program, push grads into array
        foreach($programs as $program){
            $users = User::with(['details', 'programs'])->whereHas('role', function($query)
                    {
                        $query->where('title', '=', 'Graduate');
                    })->whereHas('programs', function($query) use ($program)
                    {
                        $query->where('programs.id', '=', $program->id);
                    })->get();

            // merge each collection of users with master collection
            $users_grad_list = $users_grad_list->merge($users);
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
