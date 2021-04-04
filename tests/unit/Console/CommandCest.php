<?php

namespace Tests\Console;

use Centum\Container\Container;
use Tests\Console\Command\BoringCommand;
use Tests\UnitTester;

class CommandCest
{
    public function getters(UnitTester $I): void
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

        $I->assertEquals(
            [],
            $command->getMiddlewares()
        );

        $I->assertEquals(
            [],
            $command->getFilters($container)
        );
    }
}
