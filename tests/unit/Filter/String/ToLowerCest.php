<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\ToLower;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class ToLowerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
                "value"    => "Sid Roberts",
                "expected" => "sid roberts",
            ],

            [
                "value"    => "SID ROBERTS",
                "expected" => "sid roberts",
            ],

            [
                "value"    => "sid roberts",
                "expected" => "sid roberts",
            ],

            [
                "value"    => "sId RoBeRtS",
                "expected" => "sid roberts",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function exception(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
