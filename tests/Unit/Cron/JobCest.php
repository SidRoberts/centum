<?php

namespace Tests\Unit\Cron;

use Centum\Cron\Job;
use Centum\Interfaces\Cron\JobInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Cron\Job
 */
final class JobCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $job = $I->mock(Job::class);

        $I->assertInstanceOf(JobInterface::class, $job);
    }



    #[DataProvider("providerGetters")]
    public function testGetters(UnitTester $I, Example $example): void
    {
        /** @var non-empty-string */
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

    /**
     * @return array<array{expression: string, data: mixed}>
     */
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
