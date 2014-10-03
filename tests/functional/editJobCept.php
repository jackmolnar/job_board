<?php 
$I = new FunctionalTester($scenario);

$I->am('Logged in user');
$I->wantTo('edit a job posting');

$I->amLoggedAs(['email'=>'jackmolnar1982@gmail.com', 'password' => 'frontline']);
$I->seeAuthentication();

$I->amOnPage('/jobs');
$I->see('My new Job');

$I->click('Edit');
$I->see('Edit Job');

$I->fillField('title', 'My Edited Job');
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

$I->seeRecord('jobs', [
    'title' => 'My Edited Job',
    'description' => 'edited job description',
    'qualifications' => 'must be master at php',
    'pay' => '10000',
    'experience' => '20 years',
    'compensation_extras' => 'free food',
    'company_name' => 'eit',
    'company_city' => 'Meadville',
    'company_address' => '930 Peach Street',
    'company_state' => 'PA',
    'user_id' => '2',
]);

$I->see('Job successfully updated.');