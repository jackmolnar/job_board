<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in user');
$I->wantTo('edit a job posting');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '1' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$job = $I->haveAJob([
    'title' => 'My Test Job',
    'user_id' => $user->user->id
]);

$I->seeRecord('jobs', ['title' => 'My Test Job', 'user_id' => $user->user->id]);

$I->amOnPage('/jobs');
$I->see('My Test Job');
$I->click('My Test Job');
$I->seeCurrentUrlEquals('/jobs/'.$job->id);
$I->see('Edit');
$I->click('Edit');
$I->seeCurrentUrlEquals('/jobs/'.$job->id.'/edit');

$I->seeInField('title', 'My Test Job');

$I->fillField('title', 'My Tes Job');
$I->fillField('textarea[name=description]', 'edited job description');
$I->fillField('qualifications', 'must be master at php');
$I->fillField('pay', '10000');
$I->fillField('experience', '20 years');
$I->fillField('compensation_extras', 'free food');
$I->fillField('company_name', 'eit');
$I->fillField('company_city', 'Meadville');
$I->fillField('company_address', '930 Peach Street');
$I->fillField('company_state', 'PA');
$I->click('Save Job');

$I->amOnPage('/jobs');
$I->see('My Tes Job');


$I->seeRecord('jobs', [
    'title' => 'My Tes Job',
    'description' => 'edited job description',
    'qualifications' => 'must be master at php',
    'pay' => '10000',
    'experience' => '20 years',
    'compensation_extras' => 'free food',
    'company_name' => 'eit',
    'company_city' => 'Meadville',
    'company_address' => '930 Peach Street',
    'company_state' => 'PA',
    'user_id' => $user->user->id,
]);

$I->see('Job successfully updated.');

