<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 9/30/2014
 * Time: 9:15 AM
 */

namespace job_board\Validators;


abstract class jb_validator {

    public function get_messages ($validator, $message = null){
        if ($validator->fails()){
            $result['status'] = false;
            $result['messages'] = $validator->errors();
            return $result;
        }

        $result['status'] = true;
        $result['messages'] = $message != null ? $message : '';
        return $result;
    }
} 