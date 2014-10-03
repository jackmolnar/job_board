<?php 
$I = new FunctionalTester($scenario);

$I->am('a guest');
$I->wantTo('login');

$I->amOnPage('/');
$I->fillField('email', 'jackmolnar1982@gmail.com');
$I->fillField('password', 'frontline1');
$I->click('Login');

$I->amOnPage('/users');


