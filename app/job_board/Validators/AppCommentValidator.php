<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/6/2014
 * Time: 10:32 AM
 */

namespace job_board\Validators;


use Validator;

class AppCommentValidator extends jb_validator {

    /**
     * validation rules for creating new comment
     */
    protected $create_rules = array(
        'application_comment' => 'required'
    );


    /**
     * Validate the create comment input
     * @param mixed
     * @return array [status => true or false, messages => errors or success]
     */
    public function create($input){

        $validator = Validator::make($input, $this->create_rules);

        $result = parent::get_messages($validator, 'Comment posted.');

        return $result;
    }
} 