<?php

namespace Tests\Unit\Queue;

use Centum\Container\Container;
use Centum\Queue\Queue;
use Mockery;
use Pheanstalk\Job;
use Pheanstalk\Pheanstalk;
use Tests\Queue\DoNothingTask;
use Tests\Queue\ProblematicTask;
use Tests\UnitTester;
use Throwable;

class QueueCest
{
    public function publish(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $serializedTask = serialize($task);



        $job = new Job(1, $serializedTask);



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->useTube()
            ->with(Queue::TUBE);

        $pheanstalk->expects()
            ->put()
            ->with($serializedTask)
            ->andReturn($job);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $queue->publish($task);
    }

    public function consumeRegularTask(UnitTester $I): void
    {
        $task = new DoNothingTask();

        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($task));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->watch()
            ->with(Queue::TUBE);

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->delete()
            ->with($job)
            ->andReturn(true);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $queue->consume();
    }

    public function buryJobWhenExceptionIsThrown(UnitTester $I): void
    {
        $task = new ProblematicTask();

        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($task));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->watch()
            ->with(Queue::TUBE);

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->bury()
            ->with($job)
            ->andReturn(true);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $I->expectThrowable(
            Throwable::class,
            function () use ($queue) {
                $queue->consume();
            }
        );
    }
}
