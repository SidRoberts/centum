<?php

namespace Tests\Http;

use Centum\Http\Header;
use Tests\UnitTester;

class HeaderCest
{
    public function getters(UnitTester $I)
    {
        $header = new Header("cache-control", "max-age=600");

        $I->assertEquals(
            "cache-control",
            $header->getName()
        );

        $I->assertEquals(
            "max-age=600",
            $header->getValue()
        );
    }

    public function toString(UnitTester $I)
    {
        $header = new Header("cache-control", "max-age=600");

        $I->assertEquals(
            "cache-control: max-age=600\r\n",
            (string) $header
        );
    }
}
