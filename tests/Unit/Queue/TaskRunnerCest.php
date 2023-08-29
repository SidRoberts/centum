<?php

namespace Tests\Unit\Queue;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Queue\TaskRunner;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Queue\TaskRunner
 */
class TaskRunnerCest
{
    public function test(UnitTester $I): void
    {
        $container = $I->mock(ContainerInterface::class);

        $task = $I->mock(
            TaskInterface::class,
            function (MockInterface $mock) use ($container): void {
                $mock->shouldReceive("execute")
                    ->with($container)
                    ->once();
            }
        );

        $taskRunner = new TaskRunner($container);

        $taskRunner->execute($task);
    }
}
