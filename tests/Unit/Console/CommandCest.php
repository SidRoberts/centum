<?php

namespace Tests\Unit\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Container\Container;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\UnitTester;

class CommandCest
{
    public function testGetName(UnitTester $I): void
    {
        $command = new BoringCommand();

        $I->assertEquals(
            "boring",
            $command->getName()
        );
    }

    public function testGetDescription(UnitTester $I): void
    {
        $command = new BoringCommand();

        $I->assertEquals(
            "",
            $command->getDescription()
        );
    }

    public function testGetHelp(UnitTester $I): void
    {
        $command = new BoringCommand();

        $I->assertEquals(
            "",
            $command->getHelp()
        );
    }

    public function testGetMiddleware(UnitTester $I): void
    {
        $command = new BoringCommand();

        $I->assertInstanceOf(
            TrueMiddleware::class,
            $command->getMiddleware()
        );
    }

    public function testGetFilters(UnitTester $I): void
    {
        $container = new Container();

        $command = new BoringCommand();

        $I->assertEquals(
            [],
            $command->getFilters($container)
        );
    }
}
