<?php 
$I = new FunctionalTester($scenario);

$I->am("logged on user");
$I->wantTo('post a new application comment');

$I->amLoggedAs(['id' => 12, 'email'=>'jonm@glit.edu', 'password' => 'frontline1', 'role_id' => 3]);
$I->seeAuthentication();

$I->amOnPage('/users');
$I->click('My new Job');
$I->amOnPage('/jobs/6/applications/23');

$I->fillField('application_comment', 'This is my new comment.');
$I->click('Submit');

$I->amOnPage('/jobs/6/applications/23');
$I->see('This is my new comment.');
