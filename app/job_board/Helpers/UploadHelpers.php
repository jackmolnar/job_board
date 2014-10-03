<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 10/1/2014
 * Time: 11:44 AM
 */

namespace job_board\Helpers;


class UploadHelpers {

    /**
     * Format Name of Uploaded Doc
     *
     * @param string $name
     * @return string
     */
    public function format_name($name)
    {
        $orig_name = $name->getClientOriginalName();

        //remove spaces
        $clean_name = str_replace(' ', '_', $orig_name);

        //explode name, add date, and rebuild
        $name_array = explode('.', $clean_name);

        //gets extension
        $extension = end($name_array);

        $new_name = time().'_';
        foreach($name_array as $piece){
            if($piece == $extension){
                $new_name .= '.'.$piece;
            } else {
                $new_name .= $piece;
            }
        }
        return $new_name;
    }
} 