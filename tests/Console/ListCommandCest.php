<?php

namespace Tests\Console;

use Centum\Console\Command\ListCommand;
use Tests\Support\ConsoleTester;

class ListCommandCest
{
    public function basicHandle(ConsoleTester $I): void
    {
        $I->addCommand(
            new ListCommand()
        );

        $exitCode = $I->runCommand(
            [
                "cli.php",
                "list",
            ]
        );

        $I->assertEquals(
            0,
            $exitCode
        );

        $I->assertStdoutContains(
            " * list" . PHP_EOL . " * queue-consume"
        );
    }
}
