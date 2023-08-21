<?php

namespace Tests\Unit\Router\Exception;

use Centum\Router\Exception\NotAnExceptionHandlerException;
use Tests\Support\UnitTester;

class NotAnExceptionHandlerExceptionCest
{
    public function test(UnitTester $I): void
    {
        $class = self::class;

        $exception = new NotAnExceptionHandlerException($class);

        $I->assertEquals(
            $class,
            $exception->getClass()
        );
    }
}
