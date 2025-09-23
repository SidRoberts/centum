<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\ToUpper;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\ToUpper
 */
final class ToUpperCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToUpper();

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: string, output: string}>
     */
    protected function provider(): array
    {
        return [
            [
                "input"  => "Sid Roberts",
                "output" => "SID ROBERTS",
            ],

            [
                "input"  => "sid roberts",
                "output" => "SID ROBERTS",
            ],

            [
                "input"  => "SID ROBERTS",
                "output" => "SID ROBERTS",
            ],

            [
                "input"  => "sId RoBeRtS",
                "output" => "SID ROBERTS",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new ToUpper();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: mixed}>
     */
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
