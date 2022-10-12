<?php

namespace Tests\Unit\Queue;

use Centum\Container\Container;
use Centum\Queue\BeanstalkdQueue;
use Mockery\MockInterface;
use Pheanstalk\Contract\PheanstalkInterface;
use Pheanstalk\Job;
use stdClass;
use Tests\Support\Queue\DoNothingTask;
use Tests\Support\Queue\ProblematicTask;
use Tests\Support\UnitTester;
use Throwable;
use UnexpectedValueException;

class BeanstalkdQueueCest
{
    public function testPublish(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $serializedTask = serialize($task);



        $job = new Job(1, $serializedTask);



        $pheanstalk = $I->mock(
            PheanstalkInterface::class,
            function (MockInterface $mock) use ($serializedTask, $job): void {
                $mock->shouldReceive("useTube")
                    ->with(BeanstalkdQueue::TUBE);

                $mock->shouldReceive("put")
                    ->with($serializedTask)
                    ->andReturn($job);
            }
        );



        $container = new Container();

        $queue = new BeanstalkdQueue($container, $pheanstalk);

        $queue->publish($task);
    }



    public function testConsumeRegularTask(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $job = $I->mock(
            Job::class,
            function (MockInterface $mock) use ($task): void {
                $mock->shouldReceive("getData")
                    ->andReturn(serialize($task));
            }
        );

        $pheanstalk = $I->mock(
            PheanstalkInterface::class,
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

        $queue = new BeanstalkdQueue($container, $pheanstalk);

        $queue->consume();
    }

    public function testConsumeMalformedTask(UnitTester $I): void
    {
        $task = new stdClass();

        $job = $I->mock(
            Job::class,
            function (MockInterface $mock) use ($task): void {
                $mock->shouldReceive("getData")
                    ->andReturn(serialize($task));
            }
        );

        $pheanstalk = $I->mock(
            PheanstalkInterface::class,
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

        $queue = new BeanstalkdQueue($container, $pheanstalk);



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

        $job = $I->mock(
            Job::class,
            function (MockInterface $mock) use ($task): void {
                $mock->shouldReceive("getData")
                    ->andReturn(serialize($task));
            }
        );

        $pheanstalk = $I->mock(
            PheanstalkInterface::class,
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

        $queue = new BeanstalkdQueue($container, $pheanstalk);

        $I->expectThrowable(
            Throwable::class,
            function () use ($queue): void {
                $queue->consume();
            }
        );
    }
}
