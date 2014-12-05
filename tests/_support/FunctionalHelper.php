<?php
namespace Codeception\Module;
use Auth;
use Hash;
use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
    public $user;
    public $user_details;

    protected $user_overrides;
    protected $user_details_overrides;
    protected $program_overrides;

    /**
     * Create user account stub
     * @param array $user_overrides
     * @param array $user_details_overrides
     * @return $this
     */
    public function haveAnAccount($user_overrides = [], $user_details_overrides = [])
    {
        $this->user_overrides = $user_overrides;
        $this->user_details_overrides = $user_details_overrides;

        //create base user
        if(array_key_exists('password', $user_overrides)){
            $user_overrides['password'] = Hash::make($user_overrides['password']);
        }
        $this->user = TestDummy::create('User', $user_overrides);

        //create user details
        $user_details_overrides['user_id'] = $this->user->id;
        $this->user_details = TestDummy::create('UserDetails', $user_details_overrides);

        return $this;
    }

    /**
     * Log a user in
     * @return $this
     * @throws \Codeception\Exception\Module
     */
    public function logIn()
    {
        $I = $this->getModule('Laravel4');

        $I->amLoggedAs(['email'=> $this->user_overrides['email'], 'password' => $this->user_overrides['password']]);
        $I->seeAuthentication();

        return $this;
    }

    /**
     * Attach user to program
     * @param array $program_overrides
     * @return $this
     */
    public function attachedToProgram($program_overrides = [])
    {
        $this->program_overrides = $program_overrides;

        //attach a veterinary program
        $program = TestDummy::create('Program', $this->program_overrides);

        if(isset($this->user))
        {
            $this->user->programs()->attach($program->id);
        }
        return $this;
    }

    /**
     * Test Job Stub
     * @param array $overrides
     * @return mixed
     */
    public function haveAJob($overrides = [], $program_id = null)
    {
        $job = TestDummy::create('Job', $overrides);
        if($program_id == null){
            $job->programs()->attach(1);
        } else {
            $job->programs()->attach($program_id);
        }

        return $job;
    }

    public function haveAnOpenApplication($user, $job)
    {
        $overrides['user_id'] = $user->id;
        $overrides['job_id'] = $job->id;
        $overrides['status_id'] = 3;

        $application = TestDummy::create('Application', $overrides);

        return $application;
    }

}