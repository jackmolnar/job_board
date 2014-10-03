<?php
namespace Codeception\Module;
use Auth;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
    public function loggedInAdmin () {
        if(Auth::check()) return TRUE;
    }
}