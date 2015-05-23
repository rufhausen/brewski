<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page works');
$I->amOnPage('/');
$I->see('HOME');
