<?php

namespace Tests\Cron;

use Centum\Cron\CronFactory;
use Tests\UnitTester;

class CronFactoryCest
{
    public function addJobsFromArray(UnitTester $I): void
    {
        $cron = CronFactory::createFromArray(
            [
                [
                    "* * * * *",
                    [
                        "task",
                        "action",
                        "params",
                    ],
                ],
                [
                    "* * * * *",
                    "echo 'hello world'",
                ],
            ],
        );



        $I->assertCount(
            2,
            $cron->getAllJobs()
        );
    }
}
