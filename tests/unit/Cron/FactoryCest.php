<?php

namespace Tests\Cron;

use Centum\Cron\Factory;
use Tests\UnitTester;

class FactoryCest
{
    public function addJobsFromArray(UnitTester $I): void
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
