<?php

namespace Tests\Http;

use Centum\Http\Status;
use OutOfRangeException;
use Tests\UnitTester;

class StatusCest
{
    public function test(UnitTester $I)
    {
        $status = new Status(404);

        $I->assertEquals(
            404,
            $status->getCode()
        );

        $I->assertEquals(
            "Not Found",
            $status->getText()
        );
    }

    public function testUnknownCode(UnitTester $I)
    {
        $status = new Status(499);

        $I->assertEquals(
            "Unknown",
            $status->getText()
        );
    }

    public function testInvalidCode(UnitTester $I)
    {
        $I->expectThrowable(
            OutOfRangeException::class,
            function () {
                $status = new Status(999);
            }
        );
    }
}
