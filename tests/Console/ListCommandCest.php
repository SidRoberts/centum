<?php

namespace Tests\Console;

use Centum\Console\Command\ListCommand;
use Centum\Interfaces\Console\CommandInterface;
use Tests\Support\ConsoleTester;

/**
 * @covers \Centum\Console\Command\ListCommand
 */
final class ListCommandCest
{
    public function testInterfaces(ConsoleTester $I): void
    {
        $command = $I->mock(ListCommand::class);

        $I->assertInstanceOf(CommandInterface::class, $command);
    }



    public function testName(ConsoleTester $I): void
    {
        $I->seeCommandNameIs(
            ListCommand::class,
            "list"
        );
    }

    public function testDescription(ConsoleTester $I): void
    {
        $I->seeCommandDescriptionIs(
            ListCommand::class,
            "Lists all available commands."
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
            " - list" . PHP_EOL . " - queue:consume"
        );
    }
}
