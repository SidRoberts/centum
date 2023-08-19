<?php

namespace Tests\Unit\Console;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Interfaces\Queue\QueueInterface;
use Mockery\MockInterface;
use Tests\Support\ConsoleTester;

class QueueConsumeCommandCest
{
    public function testGetName(ConsoleTester $I): void
    {
        $metadata = $I->grabCommandMetadata(QueueConsumeCommand::class);

        $I->assertEquals(
            "queue:consume",
            $metadata->getName()
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
