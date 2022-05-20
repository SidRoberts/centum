<?php

namespace Tests\Unit\Cron;

use Centum\Cron\Job;
use Codeception\Example;
use Tests\UnitTester;

class JobCest
{
    /**
     * @dataProvider providerGetters
     */
    public function testGetters(UnitTester $I, Example $example): void
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

    protected function providerGetters(): array
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
