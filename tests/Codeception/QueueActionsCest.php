<?php

namespace Tests\Codeception;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\ArrayQueue;
use Centum\Queue\BeanstalkdQueue;
use Centum\Queue\ImmediateQueue;
use Exception;
use Tests\Support\CodeceptionTester;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\ProblematicTask;
use Tests\Support\Queue\Task;
use Throwable;

/**
 * @covers \Centum\Codeception\Actions\QueueActions
 */
final class QueueActionsCest
{
    public function testGrabQueue(CodeceptionTester $I): void
    {
        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $queue = new ArrayQueue($taskRunner);

        $I->addToContainer(QueueInterface::class, $queue);

        $I->assertSame(
            $queue,
            $I->grabQueue()
        );
    }

    public function testGrabTaskRunner(CodeceptionTester $I): void
    {
        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $I->addToContainer(TaskRunnerInterface::class, $taskRunner);

        $I->assertSame(
            $taskRunner,
            $I->grabTaskRunner()
        );
    }



    public function testUseArrayQueue(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $queue = $I->grabFromContainer(QueueInterface::class);

        $I->assertInstanceOf(
            ArrayQueue::class,
            $queue
        );
    }

    public function testUseImmediateQueue(CodeceptionTester $I): void
    {
        $I->useImmediateQueue();

        $queue = $I->grabFromContainer(QueueInterface::class);

        $I->assertInstanceOf(
            ImmediateQueue::class,
            $queue
        );
    }



    public function testPublishToQueue(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $task = new DoNothingTask();

        $I->publishToQueue($task);

        $I->assertEquals(
            [
                $task,
            ],
            $I->grabQueueTasks()
        );
    }



    public function testConsumeFromQueue(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $task = new Task();

        $I->publishToQueue($task);

        $I->consumeFromQueue();

        $I->assertEmpty(
            $I->grabQueueTasks()
        );

        $I->assertEmpty(
            $I->grabQueueBuriedTasks()
        );

        $I->assertTrue(
            $task->getWasExecuted()
        );
    }

    public function testConsumeFromQueueReturnsTask(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $task = new Task();

        $I->publishToQueue($task);

        $returnedTask = $I->consumeFromQueue();

        $I->assertSame(
            $task,
            $returnedTask
        );
    }



    public function testGrabQueueTasksFromArrayQueue(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $task1 = new DoNothingTask();
        $task2 = new ProblematicTask();

        $I->publishToQueue($task1);
        $I->publishToQueue($task2);

        $I->assertSame(
            [
                $task1,
                $task2,
            ],
            $I->grabQueueTasks()
        );
    }

    public function testGrabQueueTasksFromNonArrayQueue(CodeceptionTester $I): void
    {
        $I->useImmediateQueue();

        $I->expectThrowable(
            new Exception(
                sprintf(
                    "Can only retreive tasks from an %s instance.",
                    ArrayQueue::class
                )
            ),
            function () use ($I): void {
                $I->grabQueueTasks();
            }
        );
    }



    public function testGrabQueueBuriedTasksFromArrayQueue(CodeceptionTester $I): void
    {
        $I->useArrayQueue();

        $task1 = new DoNothingTask();
        $task2 = new ProblematicTask();

        try {
            $I->publishToQueue($task1);
            $I->consumeFromQueue();
        } catch (Throwable) {
        }

        try {
            $I->publishToQueue($task2);
            $I->consumeFromQueue();
        } catch (Throwable) {
        }

        $I->assertSame(
            [
                $task2,
            ],
            $I->grabQueueBuriedTasks()
        );

        $I->markTestIncomplete();
    }

    public function failToGrabQueueBuriedTasksFromBeanstalkdQueue(CodeceptionTester $I): void
    {
        $beanstalkdQueue = $I->mock(BeanstalkdQueue::class);

        $I->addToContainer(QueueInterface::class, $beanstalkdQueue);

        $I->expectThrowable(
            new Exception(
                sprintf(
                    "Can only retreive tasks buried from an %s or %s instance.",
                    ArrayQueue::class,
                    ImmediateQueue::class
                )
            ),
            function () use ($I): void {
                $I->grabQueueBuriedTasks();
            }
        );

        $I->markTestIncomplete();
    }

    public function testGrabQueueBuriedTasksFromImmediateQueue(CodeceptionTester $I): void
    {
        $I->useImmediateQueue();

        $task1 = new DoNothingTask();
        $task2 = new ProblematicTask();

        try {
            $I->publishToQueue($task1);
        } catch (Throwable) {
        }

        try {
            $I->publishToQueue($task2);
        } catch (Throwable) {
        }

        $I->assertSame(
            [
                $task2,
            ],
            $I->grabQueueBuriedTasks()
        );

        $I->markTestIncomplete();
    }



    public function testExecuteTask(CodeceptionTester $I): void
    {
        $task = new Task();

        $I->executeTask($task);

        $I->assertTrue(
            $task->getWasExecuted()
        );
    }
}
