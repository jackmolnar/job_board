<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in user');
$I->wantTo('delete a job');

$I->amLoggedAs(['email'=>'jackmolnar1982@gmail.com', 'password' => 'frontline']);
$I->seeAuthentication();

$I->amOnPage('/jobs');

$I->see('My new Job');
$I->click('Delete');

$I->amOnPage('/jobs');

$I->dontSee('My new Job');
