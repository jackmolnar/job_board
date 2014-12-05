<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in graduate');
$I->wantTo('apply for a job');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '3' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$job = $I->haveAJob(['title' => 'My new job', 'company_name' => 'glit'], $user->user->programs->first()->id);

$I->amOnPage('/jobs/'.$job->id);
$I->see('Apply');
$I->click('#apply_button');

$I->seeCurrentUrlEquals('/jobs/'.$job->id.'/applications/create');
$I->see('Request Application');

$I->fillField('message', 'I really want this job');
$I->click('Send Application Request');

$I->seeRecord('applications', [
    'job_id' => $job->id,
    'user_id' => $user->user->id,
    'status_id' => 1,
]);

$I->seeRecord('application_comments', [
    'user_id' => $user->user->id,
    'body' => 'I really want this job'
]);

$I->amOnPage('/jobs/'.$job->id);

$I->see('Application Sent.');
