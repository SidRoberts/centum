<?php

namespace Tests\Unit\Queue;

use Centum\Container\Container;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\Exception\NoTasksInQueueException;
use Centum\Queue\ImmediateQueue;
use Centum\Queue\TaskRunner;
use Exception;
use Mockery\MockInterface;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\ProblematicTask;
use Tests\Support\UnitTester;
use Throwable;

/**
 * @covers \Centum\Queue\ImmediateQueue
 */
final class ImmediateQueueCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $queue = $I->mock(ImmediateQueue::class);

        $I->assertInstanceOf(QueueInterface::class, $queue);
    }



    public function testPublish(UnitTester $I): void
    {
        $task = $I->mock(TaskInterface::class);

        $taskRunner = $I->mock(
            TaskRunnerInterface::class,
            function (MockInterface $mock) use ($task): void {
                $mock->shouldReceive("execute")
                    ->with($task)
                    ->once();
            }
        );

        $queue = new ImmediateQueue($taskRunner);

        $queue->publish($task);
    }



    public function testConsumeRegularTask(UnitTester $I): void
    {
        $task = new DoNothingTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ImmediateQueue($taskRunner);

        $queue->publish($task);



        $I->expectThrowable(
            NoTasksInQueueException::class,
            function () use ($queue): void {
                $queue->consume();
            }
        );
    }

    public function testConsumeTaskWhenQueueIsEmptyThrowsException(UnitTester $I): void
    {
        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $queue = new ImmediateQueue($taskRunner);



        $I->expectThrowable(
            NoTasksInQueueException::class,
            function () use ($queue): void {
                $queue->consume();
            }
        );
    }



    public function testBuryJobWhenExceptionIsThrown(UnitTester $I): void
    {
        $task = new ProblematicTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ImmediateQueue($taskRunner);



        $I->expectThrowable(
            Throwable::class,
            function () use ($queue, $task): void {
                $queue->publish($task);
            }
        );

        $I->assertEquals(
            [
                $task,
            ],
            $queue->getBuriedTasks()
        );
    }



    public function testGetBuriedTasks(UnitTester $I): void
    {
        $task = new ProblematicTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ImmediateQueue($taskRunner);

        $I->expectThrowable(
            Exception::class,
            function () use ($queue, $task): void {
                $queue->publish($task);
            }
        );

        $I->assertEquals(
            [
                $task,
            ],
            $queue->getBuriedTasks()
        );
    }
}
