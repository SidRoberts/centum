<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\CommandNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Exception\CommandNotFoundException
 */
class CommandNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $name = "bleh";

        $exception = new CommandNotFoundException($name);

        $I->assertEquals(
            $name,
            $exception->getName()
        );
    }
}
