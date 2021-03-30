<?php

namespace Tests\Events;

use Centum\Container\Container;
use Centum\Events\EventHandler;
use Mockery;
use Pheanstalk\Job;
use Pheanstalk\Pheanstalk;
use Tests\UnitTester;

class EventHandlerCest
{
    public function test(UnitTester $I): void
    {
        $event = new ExampleEvent();



        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($event));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->put()
            ->with(serialize($event));

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->delete()
            ->with($job)
            ->andReturn(true);



        $container = new Container();



        $eventHandler = new EventHandler($container, $pheanstalk);

        $eventHandler->handle($event);



        $I->assertEquals(
            $event,
            $eventHandler->process()
        );
    }

    public function buryJobWhenExceptionIsThrown(UnitTester $I): void
    {
        $event = new ProblematicEvent();



        $job = Mockery::mock(Job::class);

        $job->expects()
            ->getData()
            ->andReturn(serialize($event));



        $pheanstalk = Mockery::mock(Pheanstalk::class);

        $pheanstalk->expects()
            ->reserve()
            ->andReturn($job);

        $pheanstalk->expects()
            ->bury()
            ->with($job)
            ->andReturn(true);



        $container = new Container();

        $eventHandler = new EventHandler($container, $pheanstalk);

        $eventHandler->process();
    }
}
