<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Trim;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class TrimCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
                "input"  => "Sid",
                "output" => "Sid",
            ],

            [
                "input"  => "  Sid  ",
                "output" => "Sid",
            ],

            [
                "input"  => "   ",
                "output" => "",
            ],

            [
                "input"  => "",
                "output" => "",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
