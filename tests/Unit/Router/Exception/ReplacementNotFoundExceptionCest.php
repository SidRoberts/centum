<?php

namespace Tests\Unit\Router\Exception;

use Centum\Router\Exception\ReplacementNotFoundException;
use Tests\Support\UnitTester;

class ReplacementNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $key = "user";

        $exception = new ReplacementNotFoundException($key);

        $I->assertEquals(
            "Router Replacement for 'user' not found.",
            $exception->getMessage()
        );

        $I->assertSame(
            $key,
            $exception->getKey()
        );
    }
}
