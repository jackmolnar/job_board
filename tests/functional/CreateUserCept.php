<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('create a new user');

$I->amOnPage('/users/create');
$I->see('Create New User');
$I->fillField('email', 'jon@glit.edu');
$I->fillField('password', 'password');
$I->fillField('first_name', 'jack');
$I->fillField('last_name', 'wrath');
$I->selectOption('role_id', 'Employment Specialist');
$I->selectOption('program_id', 'Diagnostic Medical Sonographer');
$I->click('Create User');

$I->seeRecord('users', [
	'email' => 'jon@glit.edu',
	'first_name' => 'jack',
	'last_name' => 'wrath',
	'role_id' => '2',
	]);

$I->amOnPage('/');
$I->see('Please Log In');



