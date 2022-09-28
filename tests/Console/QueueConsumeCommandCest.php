<?php

namespace Tests\Unit\Console;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Queue\Queue;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\ConsoleTester;

class QueueConsumeCommandCest
{
    public function testGetName(ConsoleTester $I): void
    {
        $command = new QueueConsumeCommand();

        $I->assertEquals(
            "queue-consume",
            $command->getName()
        );
    }



    public function testExecute(ConsoleTester $I): void
    {
        $queue = Mockery::mock(
            QueueInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("consume")
                    ->once();
            }
        );

        $I->addToContainer(QueueInterface::class, $queue);

        $I->addCommand(
            new QueueConsumeCommand()
        );

        $exitCode = $I->runCommand(
            [
                "cli.php",
                "queue-consume",
            ]
        );

        $I->assertEquals(
            0,
            $exitCode
        );
    }
}
