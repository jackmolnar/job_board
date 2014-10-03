<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::controller('auth', 'AuthController');

Route::get('users/{id}/resume/', array('uses' => 'UsersController@getResume', 'as' => 'users.resume'));
Route::post('users/{id}/resume/', array('uses' => 'UsersController@postResume', 'as' => 'users.resume'));
Route::resource('users', 'UsersController');

Route::get('jobs/all', array('uses' => 'JobsController@all', 'as' => 'jobs.all'));
Route::get('jobs/apply/{job}', array('uses' => 'JobsController@getApply', 'as' => 'jobs.apply'));
Route::post('jobs/apply/{job}', array('uses' => 'JobsController@postApply', 'as' => 'jobs.apply'));
Route::resource('jobs', 'JobsController');

Route::resource('jobs.applications', 'ApplicationsController');

//Route::get('/jobs/all', )

Route::get('/', function()
{
	return View::make('home');

});


//View::composer("includes.main.side_nav", function ($view){
//    $view->with('role', 'not administrator');
//});

