<?php

namespace Tests\Web;

use Tests\WebTester;

class IndexCest
{
    public function tryToTest(WebTester $I): void
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(200);

        $I->see("homepage");
    }
}
