<?php 
$I = new FunctionalTester($scenario);



$I->am('a guest');
$I->wantTo('login');

$I->amOnPage('/');

$I->haveAnAccount([
    'email' => 'foo@example.com',
    'password' => 'frontline'
]);

$I->fillField('email', 'foo@example.com');
$I->fillField('password', 'frontline');
$I->click('Login');

$I->seeInCurrentUrl('/users');


