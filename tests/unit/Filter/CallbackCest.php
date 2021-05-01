<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Callback;
use Codeception\Example;
use Tests\UnitTester;

class CallbackCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Callback(
            function (mixed $value): mixed {
                return str_replace(" ", "-", strtolower($value));
            }
        );

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
                "expected" => "sid-roberts",
            ],

            [
                "value"    => "SID ROBERTS  ",
                "expected" => "sid-roberts--",
            ],
        ];
    }
}
