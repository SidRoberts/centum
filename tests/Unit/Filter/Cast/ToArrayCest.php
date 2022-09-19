<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\Filters\FancyString;
use Tests\Support\UnitTester;

class ToArrayCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToArray();

        /** @var array */
        $expected = $example["expected"];

        /** @var mixed */
        $value = $example["value"];

        $I->assertEquals(
            $expected,
            $filter->filter($value)
        );
    }

    protected function provider(): array
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