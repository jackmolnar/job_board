<?php 
$I = new FunctionalTester($scenario);

$I->am('logged in graduate');
$I->wantTo('want to withdraw an application');

$I->amLoggedAs(['id' => 12, 'email'=>'jonm@glit.edu', 'password' => 'frontline1', 'role_id' => 3]);
$I->seeAuthentication();

$I->amOnPage('/jobs/all');
$I->see('My new Job');
$I->click('My new Job');

$I->amOnPage('/jobs/6');
$I->see('Applied!');
$I->click('View Application');

$I->amOnPage('/jobs/6/applications/22');
$I->see('Withdraw Application');
$I->click('Withdraw Application');

$I->dontSeeRecord('applications', [
    'id' => '22'
]);
$I->dontSeeRecord('application_comments', [
    'application_id' => '22'
]);

$I->amOnPage('/jobs/6');
$I->see('Application Withdrawn.');

