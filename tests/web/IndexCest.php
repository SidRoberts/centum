<?php

namespace Tests\Web;

use Codeception\Util\HttpCode;
use Tests\WebTester;

class IndexCest
{
    public function tryToTest(WebTester $I): void
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->see("homepage");
    }
}
