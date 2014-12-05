<?php 
$I = new FunctionalTester($scenario);

$I->am('An administrator');
$I->wantTo('Manually invite a graduate');

$user = $I->haveAnAccount(['email' => 'example@foo.com', 'password' => 'frontline', 'role_id' => '1' ])
    ->attachedToProgram(['title' => 'Veterinary Assistant'])
    ->logIn();

$I->amOnPage('/users/all');
$I->see('Add A Graduate');
$I->click('Add A Graduate');
$I->amOnPage('/users/manual_create');

$I->fillField('email', 'jack@example.com');
$I->fillField('first_name', 'Shannon');
$I->fillField('last_name', 'Marzka');
$I->selectOption('program_id', 'Veterinary Assistant');
$I->click('Create User');

$I->seeRecord('users', [
    'email' => 'jack@example.com',
    'first_name' => 'Shannon',
    'last_name' => 'Marzka',
    'role_id' => '3',
    'employment_specialist' => $user->user->id
]);

$new_grad = $I->grabRecord('users', [
    'email' => 'jack@example.com'
]);

$program = $I->grabRecord('programs', [
    'title' => 'Veterinary Assistant'
]);

$I->seeRecord('program_user', [
    'user_id' => $new_grad->id,
    'program_id' => $program->id
]);

$I->seeRecord('user_details', [
    'user_id' => $new_grad->id
]);

$I->amOnPage('/users');
$I->see('New Graduate Created.');
