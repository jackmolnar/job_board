<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/22/2014
 * Time: 4:02 PM
 */

namespace job_board\Repositories;

use \User;


class EmploymentSpecialistRepository {

    /**
     * Get all the employment specialist users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get_all_employment_specialists()
    {
        $all = User::with(['details', 'programs'])->whereHas('role', function($query)
        {
            $query->where('title', '=', 'Administrator');
        })->get();

        return $all;
    }

    /**
     * Get the employment specialist that matches the passed in program title
     * @param string $program
     * @return mixed|null|static
     */
    public function get_employment_specialist_by_program(  $program )
    {
        // get all emp specialists
        $all = $this->get_all_employment_specialists();

        // iterate through each one
        foreach($all as $emp_specialist){

            //get their programs
            $emp_specialist_programs = $emp_specialist->programs()->get();

            //if their program matches the passed program, return that emp specialist
            foreach($emp_specialist_programs as $emp_specialist_program){
                if($emp_specialist_program->title == $program){
                    return $emp_specialist;
                }
            }

            // if none match return null
            return null;
        }
    }

    /**
     * Get the grads employment specialist
     * @param $user
     * @return bool|UserRepository|mixed|null|static
     */
    public function get_grads_employment_specialist( $user )
    {
        $user_programs = $user->programs()->get();

        // iterate through each program, if emp specialist matches, return it
        foreach($user_programs as $program){
            $emp_specialist = $this->get_employment_specialist_by_program($program->title);
        }
        if(isset($emp_specialist) && $emp_specialist != null) {
            return $emp_specialist;
        }

        return false;
    }

} 