<?php

namespace Tests\Unit\Router\Exception;

use Centum\Router\Exception\ParamNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Exception\ParamNotFoundException
 */
final class ParamNotFoundExceptionCest
{
    public function testGetKey(UnitTester $I): void
    {
        $key = "userID";

        $exception = new ParamNotFoundException($key);

        $I->assertSame(
            $key,
            $exception->getKey()
        );
    }
}
