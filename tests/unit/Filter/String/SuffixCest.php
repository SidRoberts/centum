<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Suffix;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class SuffixCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Suffix(" !!");

        $actual = $filter->filter(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "This is a sentence.",
                "expected" => "This is a sentence. !!",
            ],

            [
                "value"    => "친구야? 어디가?",
                "expected" => "친구야? 어디가? !!",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function exception(UnitTester $I, Example $example): void
    {
        $filter = new Suffix(" !!");

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $example): void {
                $actual = $filter->filter(
                    $example["value"]
                );
            }
        );
    }

    public function providerException(): array
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
