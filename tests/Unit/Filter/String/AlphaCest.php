<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Alpha;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class AlphaCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Alpha();

        /** @var string */
        $expected = $example["expected"];

        /** @var string */
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
                "value"    => "Sid Roberts",
                "expected" => "SidRoberts",
            ],

            [
                "value"    => "SidRoberts92",
                "expected" => "SidRoberts",
            ],

            [
                "value"    => "sid@sidroberts.co.uk",
                "expected" => "sidsidrobertscouk",
            ],

            [
                "value"    => "This is a sentence.",
                "expected" => "Thisisasentence",
            ],

            [
                "value"    => "https://github.com/SidRoberts/centum",
                "expected" => "httpsgithubcomSidRobertscentum",
            ],

            [
                "value"    => "그게 아니야",
                "expected" => "",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Alpha();

        /** @var mixed */
        $value = $example["value"];

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $value): void {
                $filter->filter($value);
            }
        );
    }

    protected function providerException(): array
    {
        return [
            [
                "value" => true,
            ],

            [
                "value" => 0,
            ],

            [
                "value" => 123.456,
            ],

            [
                "value" => ["1", 2, "three"],
            ],

            [
                "value" => (object) ["1", 2, "three"],
            ],
        ];
    }
}
