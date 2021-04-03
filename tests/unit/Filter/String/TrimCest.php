<?php

namespace Tests\Filter\String;

use Centum\Filter\String\Trim;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class TrimCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
                "value"    => "Sid",
                "expected" => "Sid",
            ],

            [
                "value"    => "  Sid  ",
                "expected" => "Sid",
            ],

            [
                "value"    => "   ",
                "expected" => "",
            ],

            [
                "value"    => "",
                "expected" => "",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function exception(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
