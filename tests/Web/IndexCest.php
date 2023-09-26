<?php

namespace Tests\Web;

use Codeception\Util\HttpCode;
use Tests\Support\WebTester;

final class IndexCest
{
    public function tryToTest(WebTester $I): void
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->see("homepage");
    }
}
