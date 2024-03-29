<?php

namespace Tests\Unit\Http;

use Centum\Http\Header;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Header
 */
final class HeaderCest
{
    public function testGetters(UnitTester $I): void
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

    public function testGetHeaderString(UnitTester $I): void
    {
        $header = new Header("cache-control", "max-age=600");

        $I->assertEquals(
            "cache-control: max-age=600",
            $header->getHeaderString()
        );
    }

    public function testToString(UnitTester $I): void
    {
        $header = new Header("cache-control", "max-age=600");

        $I->assertEquals(
            "cache-control: max-age=600\r\n",
            (string) $header
        );
    }
}
