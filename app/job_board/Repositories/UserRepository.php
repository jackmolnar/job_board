<?php namespace job_board\Repositories;

use job_board\Helpers\UploadHelpers;
use job_board\Helpers\UserHelpers;
use job_board\Mailers\GradMailer;
use \job_board\Validators\UserValidator;
use Maatwebsite\Excel\Facades\Excel;
use Program;
use User;
use Auth;
use DB;

class UserRepository {

	protected $validator;
    protected $upload_helper;
    protected $emp_specialist;
    protected $gradMailer;
    const RESUME_PATH = '/assets/resumes/';
    const USER_IMPORT_PATH = '/assets/excel_imports/';
    const ADMINISTRATOR_ROLE = 1;
    const EMPLOYMENT_SPECIALIST_ROLE = 2;
    const GRADUATE_ROLE = 3;
    /**
     * @var UserHelpers
     */
    private $userHelpers;

    public function __construct (UserValidator $validator, UploadHelpers $upload_helper, UserHelpers $userHelpers, EmploymentSpecialistRepository $emp_specialist, GradMailer $gradMailer){
		$this->validator        = $validator;
        $this->upload_helper    = $upload_helper;
        $this->emp_specialist   = $emp_specialist;
        $this->gradMailer       = $gradMailer;
        $this->userHelpers      = $userHelpers;
    }

	/**
	 * Create a new user
	 * @param array $input
     * @param integer $role
	 * @return object
	 */
	public function create($input, $role = 0)
    {
        //get role
        $role = $role ? $role : $input['role_id'];

        //decide what type of user to create based on role
        switch ($role) {
            case self::ADMINISTRATOR_ROLE:
                $valid = $this->validator->create_administrator($input);
                if ($valid['status']) {
                    $this->create_administrator($input);
                }
                break;
            case self::EMPLOYMENT_SPECIALIST_ROLE:
                $valid = $this->validator->create_emp_specialist($input);
                if ($valid['status']) {
                    $this->create_emp_specialist($input);
                }
                break;
            case self::GRADUATE_ROLE:
                $valid = $this->validator->create_graduate($input);
                if ($valid['status']) {
                    $this->create_graduate($input);
                }
                break;
            default :
                $valid = ['status' => false, 'messages' => 'Error: No Role Selected'];
        }

        //return result
		return $valid;
	}

    /**
     * Update
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

            //sync the users programs
            $user->programs()->sync($input['programs']);

            $user_details = $user->details;
            $user_details->phone = $input['phone'];
            $user_details->text = isset($input['text'])?$input['text']:0;
            $user_details->street1 = $input['street1'];
            $user_details->street2 = $input['street2'];
            $user_details->city = $input['city'];
            $user_details->state = $input['state'];
            $user_details->zip = $input['zip'];
            if(isset($input['employer_name'])) { $user_details->employer_name = $input['employer_name']; }
            if(isset( $input['position_title'])) { $user_details->position_title = $input['position_title']; }
            $user_details->save();

        }
        return $valid;
    }

    /**
     * Create Graduate
     * @param array $input
     * @return mixed
     */
    public function create_graduate($input)
    {
        // create random password
        $input['password'] = $this->userHelpers->random_password();

        //create the main user data
        $user = $this->userHelpers->create_main_user($input, self::GRADUATE_ROLE);

        //sync the grads programs
        $this->userHelpers->sync_programs($user, $input['program_id']);

        // create the user details row
        $this->userHelpers->create_user_details($user->id);

        //get employment specialist
        $emp_specialist = $this->emp_specialist->get_grads_employment_specialist($user);
        $emp_specialist ? $user->employment_specialist = $emp_specialist->id : null ;

        $input['invite'] = 1;
        // send grad invite mail if applicable
        if($input['invite']){
            $this->gradMailer->sendNewGradInvite($user);
        }

        // save the user
        $user->save();
    }

    public function create_administrator($input)
    {
        $user = $this->userHelpers->create_main_user($input, self::ADMINISTRATOR_ROLE);

        //sync the admin programs
        $this->userHelpers->sync_programs($user, $input['program_id']);

        // create the user details row
        $this->userHelpers->create_user_details($user->id);

        // save the user
        $user->save();
    }

    public function create_emp_specialist($input)
    {
        $user = $this->userHelpers->create_main_user($input, self::EMPLOYMENT_SPECIALIST_ROLE);

        //sync the admin programs
        $this->userHelpers->sync_programs($user, $input['program_id']);

        // create the user details row
        $this->userHelpers->create_user_details($user->id);

        // save the user
        $user->save();
    }

    /**
     * Upload new resume for User
     * @param $input | the file
     * @param $id | the user id
     * @return array $valid
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
     * Upload and process excel file for new users
     * @param $input
     * @return mixed
     */
    public function upload_excel_file($input){

        //check the file exists and is excel file
        $valid = $this->validator->upload_excel($input);

        if($valid['status'])
        {
            //format name, move to new location
            $name = $this->upload_helper->format_name($input['user_import']);
            $input['user_import']->move(public_path().self::USER_IMPORT_PATH, $name);

            //import the files contents
            $upload = Excel::load(public_path().self::USER_IMPORT_PATH.$name);
            $excel_data = $upload->toArray();

            //check required fields
            $upload = $this->upload_helper->validate_excel_file($excel_data, ['first_name', 'last_name', 'email']);

            //if passed, upload all the rows
            if($upload['status'] == true){
                foreach($excel_data as $key => $user){

                    //find the program id
                    $user['program'] = ucwords($user['program']); // make sure program uppercase
                    $program = Program::where('title', '=', $user['program'])->first(['id']);
                    $user['program_id'] = $program->id;

                    $this->create_graduate($user);
                    $upload['status'] = true;
                    $upload['messages'] = "Users have been uploaded.";
                }
            }
            //delete the uploaded file
            \File::delete(public_path().self::USER_IMPORT_PATH.$name);
        }
        return $upload;
    }

    /**
     * Get the Jobs and Applications that belong to the job author
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function job_apps($user)
    {
        $job_apps = DB::table('jobs as j')->select(['j.*','j.id as job_id', 'j.title as job_title', 'a.id as app_id', 'u.*', 's.*', 's.title as status_title', 'a.created_at as applied_date'])
                        ->join('applications as a', 'j.id', '=', 'a.job_id')
                        ->join('users as u', 'a.user_id', '=', 'u.id')
                        ->join('application_status as s', 'a.status_id', '=', 's.id')
                        ->where('j.user_id', '=', $user->id)
                        ->whereExists(function($query)
                        {
                            $query->select(DB::raw(1))
                                    ->from('applications')
                                    ->whereRaw('a.job_id = j.id');
                        })
                        ->get();

        return $job_apps;
    }

    /**
     * Get the requested user
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function get_user($id)
    {
        $user = User::with('programs')->where('id', '=', $id)->first();
        return $user;
    }

    /**
     * Get the authenticated user
     * @return object|User
     */
    public function authed_user()
    {
        $user = Auth::user();
        return $user;
    }


}