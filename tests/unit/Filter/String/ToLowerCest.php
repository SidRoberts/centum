<?php

namespace Tests\Filter\String;

use Centum\Filter\String\ToLower;
use Codeception\Example;
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
