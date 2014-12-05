<?php 
$I = new FunctionalTester($scenario);

$I->am('logged in graduate');
$I->wantTo('want to withdraw an application');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '3' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$job = $I->haveAJob(['title' => 'My new job', 'company_name' => 'glit'], $user->user->programs->first()->id);
$application = $I->haveAnOpenApplication($user->user, $job);


$I->amOnPage('/jobs/all');
$I->see('My new job');
$I->click('My new job');

$I->amOnPage('/jobs/'.$job->id);
$I->see('Applied!');
$I->click('View Application');

$I->amOnPage('/jobs/'.$job->id.'/applications/'.$application->id);
$I->see('Withdraw Application');

$app = $I->grabRecord('applications', ['user_id' => $user->user->id, 'job_id' => $job->id, 'status_id' => 3]);

//dd($app->id.'     '.$application->id);

$I->click('Withdraw Application');

$I->dontSeeRecord('applications', [
    'user_id' => $user->user->id
]);
$I->dontSeeRecord('application_comments', [
    'application_id' => $application->id
]);

$I->amOnPage('/jobs/'.$job->id);

