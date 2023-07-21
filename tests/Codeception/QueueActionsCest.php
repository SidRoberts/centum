<?php

namespace Tests\Codeception;

use Centum\Interfaces\Queue\QueueInterface;
use Centum\Queue\ArrayQueue;
use Tests\Support\CodeceptionTester;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\Task;

class QueueActionsCest
{
    public function testGrabQueue(CodeceptionTester $I): void
    {
        $container = $I->grabContainer();

        $queue = new ArrayQueue($container);

        $I->addToContainer(QueueInterface::class, $queue);

        $I->assertSame(
            $queue,
            $I->grabQueue()
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



    public function testGrabQueueTasks(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testGrabQueueBuriedTasks(CodeceptionTester $I): void
    {
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
