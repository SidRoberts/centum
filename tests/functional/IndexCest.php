<?php

namespace Tests;

class IndexCest
{
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(200);

        $I->see("homepage");
    }
}
