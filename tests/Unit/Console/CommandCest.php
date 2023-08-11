<?php

namespace Tests\Unit\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\UnitTester;

class CommandCest
{
    public function testGetMiddleware(UnitTester $I): void
    {
        $command = new BoringCommand();

        $I->assertInstanceOf(
            TrueMiddleware::class,
            $command->getMiddleware()
        );
    }
}
