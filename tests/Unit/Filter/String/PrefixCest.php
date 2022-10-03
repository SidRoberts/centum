<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Prefix;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class PrefixCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Prefix("!! ");

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
                "input"  => "This is a sentence.",
                "output" => "!! This is a sentence.",
            ],

            [
                "input"  => "친구야? 어디가?",
                "output" => "!! 친구야? 어디가?",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Prefix("!! ");

        $I->expectFilterException(
            $filter,
            $example["input"],
            new InvalidArgumentException("Value must be a string.")
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
