<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\NotACommandException;
use Tests\Support\UnitTester;

class NotACommandExceptionCest
{
    public function test(UnitTester $I): void
    {
        $class = self::class;

        $exception = new NotACommandException($class);

        $I->assertEquals(
            $class,
            $exception->getClass()
        );
    }
}
