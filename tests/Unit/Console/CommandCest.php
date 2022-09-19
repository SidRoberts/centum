<?php

namespace Tests\Unit\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Container\Container;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\UnitTester;

class CommandCest
{
    public function testGetters(UnitTester $I): void
    {
        $container = new Container();

        $command = new BoringCommand();

        $I->assertEquals(
            "boring",
            $command->getName()
        );

        $I->assertEquals(
            "",
            $command->getDescription()
        );

        $I->assertEquals(
            "",
            $command->getHelp()
        );

        $I->assertInstanceOf(
            TrueMiddleware::class,
            $command->getMiddleware()
        );

        $I->assertEquals(
            [],
            $command->getFilters($container)
        );
    }
}
