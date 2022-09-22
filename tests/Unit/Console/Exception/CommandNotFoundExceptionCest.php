<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\CommandNotFoundException;
use Tests\Support\UnitTester;

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
