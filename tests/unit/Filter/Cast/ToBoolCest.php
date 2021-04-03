<?php

namespace Tests\Filter\Cast;

use Centum\Filter\Cast\ToBool;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class ToBoolCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToBool();

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
                "value"    => [1,2,3],
                "expected" => true,
            ],

            [
                "value"    => [],
                "expected" => false,
            ],

            [
                "value"    => true,
                "expected" => true,
            ],

            [
                "value"    => false,
                "expected" => false,
            ],

            [
                "value"    => 123.456,
                "expected" => true,
            ],

            [
                "value"    => 123,
                "expected" => true,
            ],

            [
                "value"    => 0,
                "expected" => false,
            ],

            [
                "value"    => null,
                "expected" => false,
            ],

            [
                "value"    => new stdClass(),
                "expected" => true,
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => true,
            ],

            [
                "value"    => "",
                "expected" => false,
            ],
        ];
    }
}
