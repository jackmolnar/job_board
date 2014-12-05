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
//auth route
Route::controller('auth', 'AuthController');
Route::controller('password', 'RemindersController');

/*
 * Resume Routes
 */
Route::get('users/{id}/resume/', array('uses' => 'UsersController@getResume', 'as' => 'users.resume'));
Route::post('users/{id}/resume/', array('uses' => 'UsersController@postResume', 'as' => 'users.resume'));

/*
 * User Routes
 */
Route::get('users/all', array('uses' => 'UsersController@all', 'as' => 'users.all'));
Route::get('users/manual_create', array('uses' => 'UsersController@manual_create', 'as' => 'users.manual_create'));
Route::post('users/manual_create', array('uses' => 'UsersController@manual_store', 'as' => 'users.manual_store'));
Route::get('users/import_create', array('uses' => 'UsersController@import_create', 'as' => 'users.import_create'));
Route::post('users/import_create', array('uses' => 'UsersController@import_store', 'as' => 'users.import_store'));
Route::get('users/{id}/edit_grad', array('uses' => 'UsersController@getUpdateGrad', 'as' => 'users.edit_grad'));
Route::post('users/{id}', array('uses' => 'UsersController@postUpdateGrad', 'as' => 'users.update_grad'));
Route::resource('users', 'UsersController');

/*
 * Job Routes
 */
Route::get('jobs/all', array('uses' => 'JobsController@all', 'as' => 'jobs.all'));
Route::get('jobs/apply/{job}', array('uses' => 'JobsController@getApply', 'as' => 'jobs.apply'));
Route::post('jobs/apply/{job}', array('uses' => 'JobsController@postApply', 'as' => 'jobs.apply'));
Route::resource('jobs', 'JobsController');

/*
 * Application Routes
 */
Route::post('jobs/{job}/applications/{app}/status', array('uses' => 'ApplicationStatusController@store', 'as' => 'jobs.applications.statusChange'));
Route::resource('jobs.applications.app-comments', 'ApplicationCommentsController');
Route::resource('jobs.applications', 'ApplicationsController');

/*
 * Home Route
 */
Route::get('/', function()
{
	return View::make('home');

});


//View::composer("includes.main.side_nav", function ($view){
//    $view->with('role', 'not administrator');
//});

