<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\NotAnExceptionHandlerException;
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
