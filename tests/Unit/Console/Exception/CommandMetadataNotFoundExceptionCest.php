<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\CommandMetadataNotFoundException;
use Tests\Support\UnitTester;

class CommandMetadataNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $class = self::class;

        $exception = new CommandMetadataNotFoundException($class);

        $I->assertEquals(
            $class,
            $exception->getClass()
        );
    }
}
