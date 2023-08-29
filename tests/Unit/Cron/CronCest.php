<?php

namespace Tests\Unit\Cron;

use Centum\Cron\Cron;
use Centum\Cron\Job;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Cron\Cron
 */
class CronCest
{
    public function testAddJobsToCron(UnitTester $I): void
    {
        $cron = new Cron();

        $job1 = new Job(
            "* * * * *",
            [
                "task",
                "action",
                "params",
            ]
        );

        $job2 = new Job(
            "* * * * *",
            "echo 'hello world'"
        );



        $I->assertCount(
            0,
            $cron->getDueJobs()
        );



        $cron->add($job1);

        $I->assertCount(
            1,
            $cron->getDueJobs()
        );



        $cron->add($job2);

        $I->assertCount(
            2,
            $cron->getDueJobs()
        );
    }
}
