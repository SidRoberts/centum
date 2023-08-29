<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\ToLower;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\ToLower
 */
class ToLowerCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
                "output" => "sid roberts",
            ],

            [
                "input"  => "SID ROBERTS",
                "output" => "sid roberts",
            ],

            [
                "input"  => "sid roberts",
                "output" => "sid roberts",
            ],

            [
                "input"  => "sId RoBeRtS",
                "output" => "sid roberts",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
