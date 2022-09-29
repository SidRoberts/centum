<?php

namespace Tests\Console;

use Centum\Console\Command\ListCommand;
use Tests\Support\ConsoleTester;

class ListCommandCest
{
    public function testGetName(ConsoleTester $I): void
    {
        $command = new ListCommand();

        $I->assertEquals(
            "list",
            $command->getName()
        );
    }

    public function testGetDescription(ConsoleTester $I): void
    {
        $command = new ListCommand();

        $I->assertEquals(
            "Lists all available commands.",
            $command->getDescription()
        );
    }



    public function testExecute(ConsoleTester $I): void
    {
        $I->addCommand(
            new ListCommand()
        );

        $I->runCommand(
            [
                "cli.php",
                "list",
            ]
        );

        $I->assertExitCodeIs(0);

        $I->assertStdoutContains(
            " * list" . PHP_EOL . " * queue-consume"
        );
    }
}
