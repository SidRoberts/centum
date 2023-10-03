<?php

namespace Tests\Unit\Console;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Interfaces\Queue\QueueInterface;
use Mockery\MockInterface;
use Tests\Support\ConsoleTester;

/**
 * @covers \Centum\Console\Command\QueueConsumeCommand
 */
final class QueueConsumeCommandCest
{
    public function testName(ConsoleTester $I): void
    {
        $I->seeCommandNameIs(
            QueueConsumeCommand::class,
            "queue:consume"
        );
    }

    public function testDescription(ConsoleTester $I): void
    {
        $I->seeCommandDescriptionIs(
            QueueConsumeCommand::class,
            ""
        );
    }



    public function testExecute(ConsoleTester $I): void
    {
        $I->mockInContainer(
            QueueInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("consume")
                    ->once();
            }
        );

        $I->addCommand(QueueConsumeCommand::class);

        $I->runCommand(
            [
                "cli.php",
                "queue:consume",
            ]
        );

        $I->seeExitCodeIs(0);
    }
}
