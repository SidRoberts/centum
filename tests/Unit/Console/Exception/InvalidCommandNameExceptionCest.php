<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\InvalidCommandNameException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Exception\InvalidCommandNameException
 */
final class InvalidCommandNameExceptionCest
{
    public function test(UnitTester $I): void
    {
        $badName = "https://github.com/";

        $exception = new InvalidCommandNameException($badName);

        $I->assertEquals(
            sprintf(
                "Command name (%s) is not valid.",
                $badName
            ),
            $exception->getMessage()
        );

        $I->assertSame(
            $badName,
            $exception->getName()
        );
    }
}
