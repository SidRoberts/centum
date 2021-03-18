<?php

namespace Tests\Cron;

use Centum\Cron\Job;
use Centum\Cron\Cron;
use Tests\UnitTester;

class CronCest
{
    public function addJobsToCron(UnitTester $I) : void
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
