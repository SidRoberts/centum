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
                "input"  => "Sid Roberts",
                "output" => "SidRoberts",
            ],

            [
                "input"  => "SidRoberts92",
                "output" => "SidRoberts",
            ],

            [
                "input"  => "sid@sidroberts.co.uk",
                "output" => "sidsidrobertscouk",
            ],

            [
                "input"  => "This is a sentence.",
                "output" => "Thisisasentence",
            ],

            [
                "input"  => "https://github.com/SidRoberts/centum",
                "output" => "httpsgithubcomSidRobertscentum",
            ],

            [
                "input"  => "그게 아니야",
                "output" => "",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Alpha();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

    protected function providerException(): array
    {
        return [
            [
                "input" => true,
            ],

            [
                "input" => 0,
            ],

            [
                "input" => 123.456,
            ],

            [
                "input" => ["1", 2, "three"],
            ],

            [
                "input" => (object) ["1", 2, "three"],
            ],
        ];
    }
}
