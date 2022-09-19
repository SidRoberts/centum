<?php

namespace Tests\Console;

use Centum\Console\Command\QueueConsumeCommand;
use Centum\Queue\Queue;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\ConsoleTester;

class QueueConsumeCommandCest
{
    public function basicHandle(ConsoleTester $I): void
    {
        $queue = Mockery::mock(
            Queue::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("consume")
                    ->once();
            }
        );

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