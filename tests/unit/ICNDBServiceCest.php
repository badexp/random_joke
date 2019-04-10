<?php namespace App\Tests;
use App\Model\Joke;
use App\Service\ICNDBService;
use App\Tests\UnitTester;

class ICNDBServiceCest
{
    public function _before(UnitTester $I)
    {
    }

    public function getCategoriesTest(UnitTester $I, ICNDBService $service)
    {
        $I->wantToTest('ICNDB getCategories implementation');
        $I->wantTo('getCategories returns array with at least 1 category');
        $categories = $service->getCategories();
        $I->assertNotNull($categories);
        $I->assertNotEmpty($categories[0]);
    }

    public function getRandomTest(UnitTester $I, ICNDBService $service)
    {
        $I->wantToTest('ICNDB getRandom implementation');
        $I->wantTo('getRandom returns strings with at least 3 symbols length');
        $joke = $service->getRandom();
        $I->assertInstanceOf(Joke::class, $joke);
        $I->wantToTest('that I get really random joke');
        $firstJoke = $joke->getText();
        $secondJoke = $service->getRandom()->getText();
        $I->assertNotEquals($firstJoke, $secondJoke);
    }
}
