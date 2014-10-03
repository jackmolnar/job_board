<?php 
$I = new FunctionalTester($scenario);

$I->am('logged in user');
$I->wantTo('Create a new job posting');

$I->amLoggedAs(['email'=>'jackmolnar1982@gmail.com', 'password' => 'frontline']);
$I->seeAuthentication();

$I->amOnPage('/users');
$I->seeLink('Manage Jobs');
$I->click('Manage Jobs');
$I->seeCurrentUrlEquals('/jobs');
$I->see('Manage Jobs');
$I->click('Post New Job');
$I->amOnPage('/jobs/create');

$I->fillField('title', 'My New Job');
//$I->selectOption('programs[]', 'Dental Assistant');
$I->fillField('textarea[name=description]', 'This is what the job is all about');
$I->fillField('qualifications', '5 Years of experience');
$I->fillField('pay', '50000');
$I->fillField('experience', '10years');
$I->fillField('compensation_extras', 'vacation');
$I->fillField('company_name', 'glit');
$I->fillField('company_city', 'Erie');
$I->fillField('company_address', '5100 peach street');
$I->fillField('company_state', 'PA');

$I->click('Post Job');

$I->seeRecord('jobs', [
    'title' => 'My New Job',
    'description' => 'This is what the job is all about',
    'qualifications' => '5 Years of experience',
    'pay' => '50000',
    'experience' => '10years',
    'compensation_extras' => 'vacation',
    'company_name' => 'glit',
    'company_city' => 'Erie',
    'company_address' => '5100 peach street',
    'company_state' => 'PA',
    'user_id' => '2',
]);



$I->see('Job successfully posted.');