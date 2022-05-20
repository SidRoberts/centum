<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Prefix;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class PrefixCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Prefix("!! ");

        $actual = $filter->filter(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider(): array
    {
        return [
            [
                "value"    => "This is a sentence.",
                "expected" => "!! This is a sentence.",
            ],

            [
                "value"    => "친구야? 어디가?",
                "expected" => "!! 친구야? 어디가?",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Prefix("!! ");

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $example): void {
                $actual = $filter->filter(
                    $example["value"]
                );
            }
        );
    }

    protected function providerException(): array
    {
        return [
            [
                "value" => true,
            ],

            [
                "value" => 0,
            ],

            [
                "value" => 123.456,
            ],

            [
                "value" => ["1", 2, "three"],
            ],

            [
                "value" => (object) ["1", 2, "three"],
            ],
        ];
    }
}
