<?php
$I = new AcceptanceTester($scenario);

$I->am('logged in user');
$I->wantTo('Create a new job posting');

$I->amOnPage('/users');
$I->seeLink('Manage Jobs');
$I->click('Manage Jobs');
$I->seeCurrentUrlEquals('/jobs');
$I->see('Manage Jobs');
$I->click('Post New Job');
$I->amOnPage('/jobs/create');
$I->fillField('title', 'My New Job');
$I->fillField('description', 'This is what the job is all about');
$I->fillField('qualifications', '5 Years of experience');
$I->fillField('salary', '50000');
$I->fillField('experience', '10years');
$I->fillField('compensation', 'vacation');
$I->fillField('company', 'glit');
$I->fillField('city', 'Erie');
$I->fillField('address', '5100 peach street');
$I->fillField('state', 'PA');
$I->click('Post Job');

$I->seeRecord('jobs', [
    'title' => 'My New Job',
    'description' => 'This is what the job is all about',
    'qualifications' => '5 Years of experience',
    'salary' => '50000',
    'experience' => '10years',
    'compensation' => 'vacation',
    'company' => 'glit',
    'city' => 'Erie',
    'address' => '10years',
    'state' => 'PA',
]);