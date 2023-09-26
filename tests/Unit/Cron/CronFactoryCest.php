<?php

namespace Tests\Unit\Cron;

use Centum\Cron\CronFactory;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Cron\CronFactory
 */
final class CronFactoryCest
{
    public function testAddJobsFromArray(UnitTester $I): void
    {
        $cronFactory = new CronFactory();

        $cron = $cronFactory->createFromArray(
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
