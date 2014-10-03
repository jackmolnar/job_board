<?php
/**
 * Created by PhpStorm.
 * User: jmolnar
 * Date: 9/25/2014
 * Time: 11:00 AM
 */

namespace job_board\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     *  Register the view composers to the IOC
     */
    public function register(){
        $this->app->view->composer('templates.main', 'job_board\Composers\MainTemplateComposer');
    }

} 