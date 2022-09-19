<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\InvalidCommandNameException;
use Tests\Support\Commands\BadNameCommand;
use Tests\Support\UnitTester;

class InvalidCommandNameExceptionCest
{
    public function test(UnitTester $I): void
    {
        $command = new BadNameCommand();

        $exception = new InvalidCommandNameException($command);

        $I->assertEquals(
            "Command name ('https://github.com/') is not valid.",
            $exception->getMessage()
        );

        $I->assertSame(
            $command,
            $exception->getCommand()
        );
    }
}