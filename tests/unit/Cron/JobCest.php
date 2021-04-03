<?php

namespace Tests\Cron;

use Centum\Cron\Job;
use Codeception\Example;
use Tests\UnitTester;

class JobCest
{
    /**
     * @dataProvider providerGetters
     */
    public function getters(UnitTester $I, Example $example): void
    {
        $job = new Job(
            $example["expression"],
            $example["data"]
        );



        $I->assertEquals(
            $example["expression"],
            $job->getExpression()
        );

        $I->assertEquals(
            $example["data"],
            $job->getData()
        );
    }



    public function providerGetters(): array
    {
        return [
            [
                "expression" => "* * * * *",
                "data"       => [
                    "param1" => "hello",
                    "param2" => "world",
                ],
            ],

            [
                "expression" => "* * * * *",
                "data"       => "echo 'hello world'",
            ],
        ];
    }
}
