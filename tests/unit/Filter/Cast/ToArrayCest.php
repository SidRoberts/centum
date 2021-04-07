<?php

namespace Tests\Filter\Cast;

use Centum\Filter\Cast\ToArray;
use Codeception\Example;
use stdClass;
use Tests\Filter\FancyString;
use Tests\UnitTester;

class ToArrayCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToArray();

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
                "expected" => [1,2,3],
            ],

            [
                "value"    => true,
                "expected" => [true],
            ],

            [
                "value"    => false,
                "expected" => [false],
            ],

            [
                "value"    => 123.456,
                "expected" => [123.456],
            ],

            [
                "value"    => 123,
                "expected" => [123],
            ],

            [
                "value"    => null,
                "expected" => [],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [],
            ],

            [
                "value"    => new FancyString("Sid Roberts"),
                "expected" => ["Sid", "Roberts"],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => ["Sid Roberts"],
            ],
        ];
    }
}
