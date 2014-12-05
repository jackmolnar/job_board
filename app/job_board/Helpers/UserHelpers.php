<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/30/2014
 * Time: 8:33 AM
 */

namespace job_board\Helpers;
use User;
use Hash;
use UserDetails;

class UserHelpers {


    /**
     * Create the main user record
     * @param array $input
     * @param null $role
     * @return static
     */
    public function create_main_user($input, $role = null)
    {
        $user = User::updateOrCreate(['email' => $input['email']],[
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'role_id' => $role ? $role : $input['role_id']
        ]);
        return $user;
    }

    /**
     * Create User Details Row
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function create_user_details($id)
    {
        $user_details = UserDetails::updateOrCreate(['user_id' => $id], ['user_id' => $id]);
        return $user_details;
    }

    /**
     * Sync Users Programs
     * @param $user
     * @param $input
     */
    public function sync_programs($user, $input)
    {
        $input = is_array($input) ? $input : array($input);
        $user->programs()->sync($input);
    }

    public function random_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }


} 