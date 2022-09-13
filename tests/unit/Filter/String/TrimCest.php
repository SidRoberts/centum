<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Trim;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class TrimCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
                "value"    => "Sid",
                "expected" => "Sid",
            ],

            [
                "value"    => "  Sid  ",
                "expected" => "Sid",
            ],

            [
                "value"    => "   ",
                "expected" => "",
            ],

            [
                "value"    => "",
                "expected" => "",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

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
