<?php

namespace Tests\Web;

use Tests\WebTester;

class IndexCest
{
    public function tryToTest(WebTester $I)
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(200);

        $I->see("homepage");
    }
}
