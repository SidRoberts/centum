<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\CookieNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Exception\CookieNotFoundException
 */
final class CookieNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $name = "username";

        $exception = new CookieNotFoundException($name);

        $I->assertEquals(
            $name,
            $exception->getName()
        );
    }
}
