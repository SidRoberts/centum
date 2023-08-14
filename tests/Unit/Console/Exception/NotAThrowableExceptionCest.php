<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\NotAThrowableException;
use Tests\Support\UnitTester;

class NotAThrowableExceptionCest
{
    public function test(UnitTester $I): void
    {
        $class = self::class;

        $exception = new NotAThrowableException($class);

        $I->assertEquals(
            $class,
            $exception->getClass()
        );
    }
}
