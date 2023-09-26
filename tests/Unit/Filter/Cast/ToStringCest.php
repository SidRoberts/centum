<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToString;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\Filters\FancyString;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Cast\ToString
 */
final class ToStringCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToString();

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    protected function provider(): array
    {
        return [
            [
                "input"  => [1, 2, 3],
                "output" => "[1,2,3]",
            ],

            [
                "input"  => true,
                "output" => "1",
            ],

            [
                "input"  => 123.456,
                "output" => "123.456",
            ],

            [
                "input"  => 123,
                "output" => "123",
            ],

            [
                "input"  => null,
                "output" => "",
            ],

            [
                "input"  => new stdClass(),
                "output" => "O:8:\"stdClass\":0:{}",
            ],

            [
                "input"  => new FancyString("Sid Roberts"),
                "output" => "Sid Roberts",
            ],

            [
                "input"  => "Sid Roberts",
                "output" => "Sid Roberts",
            ],
        ];
    }
}
