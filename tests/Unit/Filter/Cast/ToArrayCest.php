<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\Filters\FancyString;
use Tests\Support\UnitTester;
use UnexpectedValueException;

class ToArrayCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToArray();

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
                "input"  => [1,2,3],
                "output" => [1,2,3],
            ],

            [
                "input"  => true,
                "output" => [true],
            ],

            [
                "input"  => false,
                "output" => [false],
            ],

            [
                "input"  => 123.456,
                "output" => [123.456],
            ],

            [
                "input"  => 123,
                "output" => [123],
            ],

            [
                "input"  => null,
                "output" => [],
            ],

            [
                "input"  => new stdClass(),
                "output" => [],
            ],

            [
                "input"  => new FancyString("Sid Roberts"),
                "output" => ["Sid", "Roberts"],
            ],

            [
                "input"  => "Sid Roberts",
                "output" => ["Sid Roberts"],
            ],
        ];
    }



    public function testToArrayReturnsAnUnexpectedValue(UnitTester $I): void
    {
        $input = new class {
            public function toArray(): string
            {
                return "you're not expecting this.";
            }
        };

        $filter = new ToArray();

        $I->expectFilterException(
            $filter,
            $input,
            new UnexpectedValueException("toArray() did not return an array.")
        );
    }
}
