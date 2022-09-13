<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\ToLower;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class ToLowerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
                "expected" => "sid roberts",
            ],

            [
                "value"    => "SID ROBERTS",
                "expected" => "sid roberts",
            ],

            [
                "value"    => "sid roberts",
                "expected" => "sid roberts",
            ],

            [
                "value"    => "sId RoBeRtS",
                "expected" => "sid roberts",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new ToLower();

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
