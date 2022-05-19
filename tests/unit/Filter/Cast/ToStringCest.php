<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToString;
use Codeception\Example;
use stdClass;
use Tests\Filters\FancyString;
use Tests\UnitTester;

class ToStringCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToString();

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
                "expected" => "[1,2,3]",
            ],

            [
                "value"    => true,
                "expected" => "1",
            ],

            [
                "value"    => 123.456,
                "expected" => "123.456",
            ],

            [
                "value"    => 123,
                "expected" => "123",
            ],

            [
                "value"    => null,
                "expected" => "",
            ],

            [
                "value"    => new stdClass(),
                "expected" => "O:8:\"stdClass\":0:{}",
            ],

            [
                "value"    => new FancyString("Sid Roberts"),
                "expected" => "Sid Roberts",
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => "Sid Roberts",
            ],
        ];
    }
}
