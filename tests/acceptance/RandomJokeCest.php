<?php

namespace App\Tests;
use App\Tests\AcceptanceTester;

class RandomJokeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function randomJokeForm(AcceptanceTester $I)
    {
        $I->amGoingTo('open the / main page');
        $I->amOnPage('/');
        $I->wantTo('see random joke form');
        $I->seeElement('form');
        $I->wantTo('see correct form title');
        $I->see('Get random joke for free!');
    }

    public function checkFormSubmit(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wantTo('submit joke form without errors');
        $I->fillField('random_joke[email]', 'i.ushakov98@gmail.com');
        $I->submitForm('form', []);
        $I->canSeeResponseCodeIsSuccessful();
        $I->dontSee('error');
    }
}
