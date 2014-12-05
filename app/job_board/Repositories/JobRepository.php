<?php namespace job_board\Repositories;

use User;
use Job;
use Auth;
use \job_board\Validators\JobValidator;



class JobRepository {

	protected $validator;

	public function __construct (JobValidator $validator){
		$this->validator = $validator;
	}

	/**
	 * Create a new job
	 * @param array $input
	 * @return mixed
	 */
	public function create($input){

		$valid = $this->validator->create($input);

		if($valid['status']){

            $job = Job::create([
                'title' => $input['title'],
                'description' => $input['description'],
                'qualifications' => $input['qualifications'],
                'pay' => $input['pay'],
                'experience' => $input['experience'],
                'compensation_extras' => $input['compensation_extras'],
                'contact_link' => $input['contact_link'],
                'contact_email' => $input['contact_email'],
                'confidential' => isset($input['confidential']) ? $input['confidential'] : 0,
                'company_name' => $input['company_name'],
                'company_city' => $input['company_city'],
                'company_address' => $input['company_address'],
                'company_state' => $input['company_state'],
            ]);

			//associate with creating user
			$job->user_id = Auth::user()->id;

            //attach the program
            $job->programs()->sync($input['programs']);

            //save the model
			$job->save();
		}
		return $valid;
	}

	/**
	 * Update a job
	 * @param array $input, integer $id
	 * @return mixed
	 */
	public function update($input, $id){

		//create and update validator the same
		$valid = $this->validator->update($input);

        if($valid['status']){

			$job = Job::find($id);
            $job->title = $input['title'];
            $job->description = $input['description'];
            $job->qualifications = $input['qualifications'];
            $job->pay = $input['pay'];
            $job->experience = $input['experience'];
            $job->compensation_extras = $input['compensation_extras'];
            $job->contact_link = $input['contact_link'];
            $job->contact_email = $input['contact_email'];
            $job->confidential = isset($input['confidential']) ? $input['confidential'] : 0;
            $job->company_name = $input['company_name'];
            $job->company_city = $input['company_city'];
            $job->company_address = $input['company_address'];
            $job->company_state = $input['company_state'];

            $job->programs()->sync($input['programs']);

            $job->save();
		}
		return $valid;
	}

    /**
     * Update a job
     * @param mixed
     * @return mixed
     */
    public function delete($id){
        $job = Job::find($id);
        $job->delete();
        $result['messages'] = 'Job successfully deleted.';
        return $result;
    }

	/**
	 * Get the jobs a user has created
	 * @param mixed
	 * @return newly created job object
	 */
	public function get_authors_jobs($id){

		$jobs = Job::with('programs')->where('user_id', '=', $id)->paginate(10);
		return $jobs;
	}

	/**
	 * Get job by id
	 * @param string $id
	 * @return the job record
	 */
	public function get_job($id){
		$job = Job::with('programs')->where('id', '=', $id)->first();
		return$job;
	}

    /**
     * Get the jobs from the programs the user graduated from
     *
     * @param $user
     * @return array
     */
    public function get_grads_jobs($user){

        //works for one job
        //$jobs = $user->programs->first()->jobs;

        $jobs = array();

        $programs = $user->programs->all();

        foreach($programs as $program){
            $program_jobs = $program->jobs->all();
            array_push($jobs, $program_jobs);
        }

        return $jobs;

    }


}