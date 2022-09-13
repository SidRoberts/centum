<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\ToUpper;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class ToUpperCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToUpper();

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
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "sid roberts",
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "SID ROBERTS",
                "expected" => "SID ROBERTS",
            ],

            [
                "value"    => "sId RoBeRtS",
                "expected" => "SID ROBERTS",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new ToUpper();

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
