<?php

namespace Tests\Unit\Http;

use Centum\Http\Status;
use Tests\UnitTester;
use ValueError;

class StatusCest
{
    public function test(UnitTester $I)
    {
        $status = Status::NOT_FOUND;

        $I->assertEquals(
            404,
            $status->getCode()
        );

        $I->assertEquals(
            "Not Found",
            $status->getText()
        );
    }

    public function testInvalidCode(UnitTester $I)
    {
        $I->expectThrowable(
            ValueError::class,
            function () {
                $status = Status::from(999);
            }
        );
    }

    public function testIsRedirect(UnitTester $I)
    {
        $I->assertFalse(
            Status::OK->isRedirect()
        );

        $I->assertTrue(
            Status::FOUND->isRedirect()
        );
    }

    public function testGetHeaderString(UnitTester $I)
    {
        $I->assertEquals(
            "HTTP/1.0 200 OK",
            Status::OK->getHeaderString()
        );

        $I->assertEquals(
            "HTTP/1.0 404 Not Found",
            Status::NOT_FOUND->getHeaderString()
        );
    }
}
