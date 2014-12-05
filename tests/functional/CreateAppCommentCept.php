<?php 
$I = new FunctionalTester($scenario);

$I->am("a logged on grad");
$I->wantTo('post a new application comment');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '3' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$job = $I->haveAJob(['title' => 'My new job', 'company_name' => 'glit'], $user->user->programs->first()->id);

$application = $I->haveAnOpenApplication($user->user, $job);

$I->amOnPage('/jobs/'.$job->id.'/applications/'.$application->id);

$I->fillField('application_comment', 'This is my new comment.');
$I->click('Submit');

$I->amOnPage('/jobs/'.$job->id.'/applications/'.$application->id);
$I->see('This is my new comment.');
