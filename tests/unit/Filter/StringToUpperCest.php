<?php

namespace Tests\Flash;

use Centum\Filter\StringToUpper;
use Codeception\Example;
use Tests\UnitTester;

class StringToUpperCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new StringToUpper();

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
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "sid roberts",
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "SID ROBERTS",
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "sId RoBeRtS",
                "expected" => "SID ROBERTS",
            ],
        ];
    }
}
