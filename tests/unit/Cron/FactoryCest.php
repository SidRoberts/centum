<?php

namespace Tests\Cron;

use Centum\Cron\Cron;
use Centum\Cron\Factory;
use Centum\Cron\Job;
use Tests\UnitTester;

class FactoryCest
{
    public function addJobsFromArray(UnitTester $I)
    {
        $cron = Factory::buildFromArray(
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
