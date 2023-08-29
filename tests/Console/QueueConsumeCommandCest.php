<?php

namespace Tests\Unit\Console;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Interfaces\Queue\QueueInterface;
use Mockery\MockInterface;
use Tests\Support\ConsoleTester;

/**
 * @covers \Centum\Console\Command\QueueConsumeCommand
 */
class QueueConsumeCommandCest
{
    public function testName(ConsoleTester $I): void
    {
        $I->assertEquals(
            "queue:consume",
            $I->grabCommandName(QueueConsumeCommand::class)
        );
    }

    public function testDescription(ConsoleTester $I): void
    {
        $I->assertEquals(
            "",
            $I->grabCommandDescription(QueueConsumeCommand::class)
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
