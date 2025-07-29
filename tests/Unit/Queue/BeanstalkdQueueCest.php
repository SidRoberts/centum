<?php

namespace Tests\Unit\Queue;

use Centum\Container\Container;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Queue\BeanstalkdQueue;
use Centum\Queue\TaskRunner;
use Mockery\MockInterface;
use Pheanstalk\Contract\PheanstalkPublisherInterface;
use Pheanstalk\Contract\PheanstalkSubscriberInterface;
use Pheanstalk\Values\Job;
use Pheanstalk\Values\JobId;
use stdClass;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\ProblematicTask;
use Tests\Support\UnitTester;
use Throwable;
use UnexpectedValueException;

/**
 * @covers \Centum\Queue\BeanstalkdQueue
 */
final class BeanstalkdQueueCest
{
    public function testPublish(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $serializedTask = serialize($task);



        $job = new Job(
            new JobId(1),
            $serializedTask
        );



        $taskRunner = $I->mock(TaskRunnerInterface::class);

        $pheanstalkPublisher = $I->mock(
            PheanstalkPublisherInterface::class,
            function (MockInterface $mock) use ($serializedTask, $job): void {
                $mock->shouldReceive("useTube")
                    ->with(BeanstalkdQueue::TUBE);

                $mock->shouldReceive("put")
                    ->with(
                        $serializedTask,
                        PheanstalkPublisherInterface::DEFAULT_PRIORITY,
                        PheanstalkPublisherInterface::DEFAULT_DELAY,
                        600
                    )
                    ->andReturn($job);
            }
        );

        $pheanstalkSubscriber = $I->mock(PheanstalkSubscriberInterface::class);



        $queue = new BeanstalkdQueue($taskRunner, $pheanstalkPublisher, $pheanstalkSubscriber);

        $queue->publish($task);
    }



    public function testConsumeRegularTask(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $job = new Job(
            new JobId(1),
            serialize($task)
        );

        $pheanstalkPublisher = $I->mock(PheanstalkPublisherInterface::class);

        $pheanstalkSubscriber = $I->mock(
            PheanstalkSubscriberInterface::class,
            function (MockInterface $mock) use ($job): void {
                $mock->shouldReceive("watch")
                    ->with(BeanstalkdQueue::TUBE);

                $mock->shouldReceive("reserve")
                    ->andReturn($job);

                $mock->shouldReceive("delete")
                    ->with($job)
                    ->andReturn(true);
            }
        );



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new BeanstalkdQueue($taskRunner, $pheanstalkPublisher, $pheanstalkSubscriber);

        $I->assertEquals(
            $task,
            $queue->consume()
        );
    }

    public function testConsumeMalformedTask(UnitTester $I): void
    {
        $task = new stdClass();

        $job = new Job(
            new JobId(1),
            serialize($task)
        );

        $pheanstalkPublisher = $I->mock(PheanstalkPublisherInterface::class);

        $pheanstalkSubscriber = $I->mock(
            PheanstalkSubscriberInterface::class,
            function (MockInterface $mock) use ($job): void {
                $mock->shouldReceive("watch")
                    ->with(BeanstalkdQueue::TUBE);

                $mock->shouldReceive("reserve")
                    ->andReturn($job);

                $mock->shouldReceive("delete")
                    ->with($job)
                    ->andReturn(true);
            }
        );



        $taskRunner = $I->mock(TaskRunnerInterface::class);



        $queue = new BeanstalkdQueue($taskRunner, $pheanstalkPublisher, $pheanstalkSubscriber);

        $I->expectThrowable(
            new UnexpectedValueException("Object from centum-tasks tube is not a Centum\\Interfaces\\Queue\\TaskInterface object."),
            function () use ($queue): void {
                $queue->consume();
            }
        );
    }



    public function testBuryJobWhenExceptionIsThrown(UnitTester $I): void
    {
        $task = new ProblematicTask();

        $job = new Job(
            new JobId(1),
            serialize($task)
        );

        $pheanstalkPublisher = $I->mock(PheanstalkPublisherInterface::class);

        $pheanstalkSubscriber = $I->mock(
            PheanstalkSubscriberInterface::class,
            function (MockInterface $mock) use ($job): void {
                $mock->shouldReceive("watch")
                    ->with(BeanstalkdQueue::TUBE);

                $mock->shouldReceive("reserve")
                    ->andReturn($job);

                $mock->shouldReceive("bury")
                    ->with($job)
                    ->andReturn(true);
            }
        );



        $container = new Container();

        $taskRunner = new TaskRunner($container);

        $queue = new BeanstalkdQueue($taskRunner, $pheanstalkPublisher, $pheanstalkSubscriber);

        $I->expectThrowable(
            Throwable::class,
            function () use ($queue): void {
                $queue->consume();
            }
        );
    }
}
