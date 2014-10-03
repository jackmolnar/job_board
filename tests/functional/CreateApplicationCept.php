<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in graduate');
$I->wantTo('apply for a job');

$I->amLoggedAs(['id' => 12, 'email'=>'jonm@glit.edu', 'password' => 'frontline1', 'role_id' => 3]);
$I->seeAuthentication();

$I->amOnPage('/jobs/all');
$I->see('My new Job');
$I->click('My new Job');

$I->amOnPage('/jobs/6');
$I->see('Apply');
$I->click('Apply');

$I->amOnPage('/jobs/6/applications/create');
$I->see('Request Application');

$I->fillField('message', 'I really want this job');
$I->click('Send Application Request');

$I->seeRecord('applications', [
    'job_id' => 6,
    'user_id' => 12,
    'status_id' => 1,
]);

$I->seeRecord('application_comments', [
    'user_id' => 12,
    'body' => 'I really want this job'
]);

$I->amOnPage('/jobs/6');

$I->see('Application Sent.');
