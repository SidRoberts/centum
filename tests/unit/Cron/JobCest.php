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
        /** @var string */
        $expression = $example["expression"];

        /** @var mixed */
        $data = $example["data"];

        $job = new Job($expression, $data);



        $I->assertEquals(
            $expression,
            $job->getExpression()
        );

        $I->assertEquals(
            $data,
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
