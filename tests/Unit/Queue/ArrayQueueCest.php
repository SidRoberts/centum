<?php

namespace Tests\Unit\Queue;

use Centum\Container\Container;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\ArrayQueue;
use Centum\Queue\Exception\NoTasksInQueueException;
use Centum\Queue\TaskRunner;
use Exception;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\ProblematicTask;
use Tests\Support\UnitTester;
use Throwable;

/**
 * @covers \Centum\Queue\ArrayQueue
 */
final class ArrayQueueCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $queue = $I->mock(ArrayQueue::class);

        $I->assertInstanceOf(QueueInterface::class, $queue);
    }



    public function testPublish(UnitTester $I): void
    {
        $task = new DoNothingTask();



        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $queue = new ArrayQueue($taskRunner);



        $queue->publish($task);



        $I->assertSame(
            [
                $task,
            ],
            $queue->getTasks()
        );
    }



    public function testConsumeRegularTask(UnitTester $I): void
    {
        $task = new DoNothingTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ArrayQueue($taskRunner);

        $queue->publish($task);



        $I->assertSame(
            $task,
            $queue->consume()
        );

        $I->assertSame(
            [],
            $queue->getTasks()
        );
    }

    public function testConsumeTaskWhenQueueIsEmptyThrowsException(UnitTester $I): void
    {
        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $queue = new ArrayQueue($taskRunner);



        $I->expectThrowable(
            NoTasksInQueueException::class,
            function () use ($queue) {
                $queue->consume();
            }
        );
    }



    public function testBuryJobWhenExceptionIsThrown(UnitTester $I): void
    {
        $task = new ProblematicTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ArrayQueue($taskRunner);

        $queue->publish($task);



        $I->expectThrowable(
            Throwable::class,
            function () use ($queue): void {
                $queue->consume();
            }
        );

        $I->assertEmpty(
            $queue->getTasks()
        );

        $I->assertEquals(
            [
                $task,
            ],
            $queue->getBuriedTasks()
        );
    }



    public function testGetTasks(UnitTester $I): void
    {
        $task1 = new DoNothingTask();
        $task2 = new ProblematicTask();



        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $queue = new ArrayQueue($taskRunner);

        $queue->publish($task1);
        $queue->publish($task2);



        $I->assertEquals(
            [
                $task1,
                $task2,
            ],
            $queue->getTasks()
        );
    }

    public function testGetBuriedTasks(UnitTester $I): void
    {
        $task = new ProblematicTask();



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new ArrayQueue($taskRunner);

        $queue->publish($task);

        $I->expectThrowable(
            Exception::class,
            function () use ($queue): void {
                $queue->consume();
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
