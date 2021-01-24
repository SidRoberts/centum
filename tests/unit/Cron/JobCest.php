<?php

namespace Centum\Tests\Cron;

use Codeception\Example;
use Centum\Cron\Job;
use Centum\Tests\UnitTester;

class JobCest
{
    /**
     * @dataProvider providerGetters
     */
    public function getters(UnitTester $I, Example $example)
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



    public function providerGetters()
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
