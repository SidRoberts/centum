<?php

namespace Tests\Console;

use Centum\Console\Command\ListCommand;
use Tests\Support\ConsoleTester;

class ListCommandCest
{
    public function testName(ConsoleTester $I): void
    {
        $I->assertEquals(
            "list",
            $I->grabCommandName(ListCommand::class)
        );
    }

    public function testDescription(ConsoleTester $I): void
    {
        $I->assertEquals(
            "Lists all available commands.",
            $I->grabCommandDescription(ListCommand::class)
        );
    }



    public function testExecute(ConsoleTester $I): void
    {
        $I->addCommand(ListCommand::class);

        $I->runCommand(
            [
                "cli.php",
                "list",
            ]
        );

        $I->seeExitCodeIs(0);

        $I->seeStdoutContains(
            " * list" . PHP_EOL . " * queue:consume"
        );
    }
}
