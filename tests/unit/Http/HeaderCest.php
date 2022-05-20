<?php

namespace Tests\Unit\Http;

use Centum\Http\Header;
use Tests\UnitTester;

class HeaderCest
{
    public function testGetters(UnitTester $I)
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

    public function testToString(UnitTester $I)
    {
        $header = new Header("cache-control", "max-age=600");

        $I->assertEquals(
            "cache-control: max-age=600\r\n",
            (string) $header
        );
    }
}
