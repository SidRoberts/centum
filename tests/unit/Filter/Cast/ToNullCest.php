<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToNull;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class ToNullCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToNull();

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
                "value"    => [1,2,3],
                "expected" => null,
            ],

            [
                "value"    => true,
                "expected" => null,
            ],

            [
                "value"    => 123.456,
                "expected" => null,
            ],

            [
                "value"    => 123,
                "expected" => null,
            ],

            [
                "value"    => null,
                "expected" => null,
            ],

            [
                "value"    => new stdClass(),
                "expected" => null,
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => null,
            ],
        ];
    }
}
