<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Alpha;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class AlphaCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Alpha();

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



    /**
     * @dataProvider providerException
     */
    public function exception(UnitTester $I, Example $example): void
    {
        $filter = new Alpha();

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $example): void {
                $actual = $filter->filter(
                    $example["value"]
                );
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
