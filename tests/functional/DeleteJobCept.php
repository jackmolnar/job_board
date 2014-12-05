<?php

//will not work with javascript delete to avoid wrapping in form

$I = new FunctionalTester($scenario);

$I->am('Logged in user');
$I->wantTo('delete a job');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '1' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$job = $I->haveAJob([
    'title' => 'My Test Job',
    'user_id' => $user->user->id
]);

$I->seeRecord('jobs', [
    'title' => 'My Test Job'
]);

$I->amOnPage('/jobs');

$I->see('My Test Job');
$I->click('My Test Job');
$I->seeCurrentUrlEquals('/jobs/'.$job->id);
$I->click('Delete');
$I->dontSeeRecord('jobs', [
    'title' => 'MyTest Job'
]);

$I->amOnPage('/jobs');
