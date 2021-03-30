<?php

namespace Tests\Flash;

use Centum\Filter\StringToLower;
use Codeception\Example;
use Tests\UnitTester;

class StringToLowerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new StringToLower();

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
}
