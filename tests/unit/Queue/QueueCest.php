<?php

namespace Tests\Queue;

use Centum\Container\Container;
use Centum\Queue\Queue;
use Codeception\Example;
use Mockery;
use Pheanstalk\Job;
use Pheanstalk\Pheanstalk;
use Tests\Queue\DoNothingTask;
use Tests\Queue\ProblematicTask;
use Tests\UnitTester;

class QueueCest
{
    public function put(UnitTester $I)
    {
        $task = new DoNothingTask();

        $serializedTask = serialize($task);



        $job = new Job(1, $serializedTask);



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->put()
            ->with($serializedTask)
            ->andReturn($job);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $queue->put($task);
    }

    public function processRegularTask(UnitTester $I)
    {
        $task = new DoNothingTask();

        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($task));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->delete()
            ->with($job)
            ->andReturn(true);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $queue->processNextTask();
    }

    public function buryJobWhenExceptionIsThrown(UnitTester $I)
    {
        $task = new ProblematicTask();

        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($task));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->bury()
            ->with($job)
            ->andReturn(true);



        $container = new Container();

        $queue = new Queue($container, $pheanstalk);

        $queue->processNextTask();
    }
}
