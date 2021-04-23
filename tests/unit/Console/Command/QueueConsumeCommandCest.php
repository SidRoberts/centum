<?php

namespace Tests\Console\Command;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Queue\Queue;
use Mockery;
use Tests\UnitTester;

class QueueConsumeCommandCest
{
    public function basicHandle(UnitTester $I): void
    {
        $queue = Mockery::mock(Queue::class);

        $queue->expects()
            ->consume()
            ->once();

        $I->addToContainer(Queue::class, $queue);

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
