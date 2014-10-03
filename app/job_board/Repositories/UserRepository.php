<?php namespace job_board\Repositories;

use job_board\Helpers\UploadHelpers;
use User;
use Hash;
use Auth;
use UserDetails;
use DB;
use \job_board\Validators\UserValidator;

class UserRepository {

	protected $validator;
    protected $upload_helper;

    const RESUME_PATH = '/assets/resumes/';

	public function __construct (UserValidator $validator, UploadHelpers $upload_helper){
		$this->validator = $validator;
        $this->upload_helper = $upload_helper;
	}
    /**
     * Get the requested user
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function get_user($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Get the authenticated user
     *
     * @return object|User
     */
    public function authed_user()
    {
        $user = Auth::user();
        return $user;
    }

	/**
	 * Create a new user
	 * @param mixed
	 * @return object
	 */
	public function create($input)
    {
		$valid = $this->validator->create($input);
		$input['password'] = Hash::make($input['password']);

		if($valid['status'])
        {
			$user = User::create([
                'email' => $input['email'],
                'password' => $input['password'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'role_id' => $input['role_id']
            ]);

            //sync the users programs
            $programs = array($input['program_id']);
            $user->programs()->sync($programs);

            // create the user details row
            $this->create_user_details($user->id);

            $user->save();
        }
		return $valid;
	}

    /**
     * Create a new user
     * @param mixed $input $id
     * @return object
     */
    public function update($input, $id)
    {
        $valid = $this->validator->update($input);

        if($valid['status'])
        {
            $user = User::find($id);
            $user->email = $input['email'];
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->last_name = $input['last_name'];
            $user->save();

            $user_details = $user->details;
            $user_details->phone = $input['phone'];
            $user_details->text = isset($input['text'])?$input['text']:0;
            $user_details->street1 = $input['street1'];
            $user_details->street2 = $input['street2'];
            $user_details->city = $input['city'];
            $user_details->state = $input['state'];
            $user_details->zip = $input['zip'];
            $user_details->save();
        }
        return $valid;
    }

    /**
     * Create User Details Row
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function create_user_details($id)
    {
        $user_details = UserDetails::create(['user_id' => $id]);
        return $user_details;
    }

    /**
     * Upload new resume for User
     *
     * @param $input | the file
     * @param $id | the user id
     */
    public function upload_resume($input, $id)
    {
        $valid = $this->validator->upload_resume($input);

        if($valid['status'])
        {
            //format name, move to new location
            $name = $this->upload_helper->format_name($input['resume']);
            $input['resume']->move(public_path().self::RESUME_PATH, $name);

            //save path in user details
            $user = $this->get_user($id);
            $user->details->resume = self::RESUME_PATH.$name;
            $user->details->save();
        }
        return $valid;
    }

    /**
     * Get the Jobs and Applications that belong to the job author
     *
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function job_apps($user)
    {
//        $jobs = $user->jobs;
//        $applications = array();
//
//        foreach($jobs as $job)
//        {
//            if($job->applications)
//            {
//                foreach($job->applications as $application)
//                {
//                    array_push($applications, $application);
//                }
//            }
//        }
//        $job_apps = Application::with(array('job' => function ($query) use ($user)
//        {
//            $query->where('user_id', '=', $user->id);
//        }))->get();

//        $job_apps = Job::where('user_id', '=', $user->id)->with(array('applications' => function ($query)
//        {
//            $query->where('status_id', '!=', 2);
//        }))->get();

//        $job_apps = DB::table('jobs')
//                        ->join('applications', 'jobs.id', '=', 'applications.job_id')
//                        ->join('users', 'applications.user_id', '=', 'users.id')
//                        ->where('jobs.user_id', '=', $user->id)
//                        ->whereExists(function($query)
//                        {
//                            $query->select(DB::raw(1))
//                                    ->from('applications')
//                                    ->whereRaw('applications.job_id = jobs.id');
//                        })
//                        ->get();
        $job_apps = DB::table('jobs as j')->select(['j.*','j.id as job_id', 'a.id as app_id', 'u.*'])
                        ->join('applications as a', 'j.id', '=', 'a.job_id')
                        ->join('users as u', 'a.user_id', '=', 'u.id')
                        ->where('j.user_id', '=', $user->id)
                        ->whereExists(function($query)
                        {
                            $query->select(DB::raw(1))
                                    ->from('applications')
                                    ->whereRaw('a.job_id = j.id');
                        })
                        ->get();

        //$job_apps = DB::statement("select j.*, a.id as app_id, u.* from `jobs` as j inner join `applications` as a on j.id = a.job_id inner join `users` as u on a.user_id = u.id where j.user_id = 2 and exists (select 1 from `applications` where a.job_id = j.id)");


        return $job_apps;
    }



}