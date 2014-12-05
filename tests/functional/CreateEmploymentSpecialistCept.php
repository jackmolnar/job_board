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

$user = $I->grabRecord('users', [
    'email' => 'jon@glit.edu'
]);

$I->seeRecord('users', [
    'id' => $user->id,
    'email' => 'jon@glit.edu',
    'first_name' => 'jack',
    'last_name' => 'wrath',
    'role_id' => '2',
]);

$I->seeRecord('user_details', [
    'user_id' => $user->id
]);

$I->seeRecord('program_user', [
    'program_id' => '2',
    'user_id' => $user->id
]);


$I->amOnPage('/');
$I->see('Please Log In');



