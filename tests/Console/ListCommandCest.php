<?php

namespace Tests\Console;

use Centum\Console\Command\ListCommand;
use Tests\Support\ConsoleTester;

class ListCommandCest
{
    public function testGetName(ConsoleTester $I): void
    {
        $metadata = $I->grabCommandMetadata(ListCommand::class);

        $I->assertEquals(
            "list",
            $metadata->getName()
        );
    }

    public function testGetDescription(ConsoleTester $I): void
    {
        $metadata = $I->grabCommandMetadata(ListCommand::class);

        $I->assertEquals(
            "Lists all available commands.",
            $metadata->getDescription()
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
