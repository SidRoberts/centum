<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Replace;
use Codeception\Example;
use InvalidArgumentException;
use Tests\UnitTester;

class ReplaceCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Replace(
            [
                "2"   => "two",
                "Sid" => "시드",
                " "   => "<SPACE>",
            ]
        );

        $actual = $filter->filter(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "123",
                "expected" => "1two3",
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => "시드<SPACE>Roberts",
            ],
        ];
    }



    /**
     * @dataProvider providerException
     */
    public function exception(UnitTester $I, Example $example): void
    {
        $filter = new Replace(
            [
                "i" => "1",
                "o" => "0",
                " " => "<SPACE>",
            ]
        );

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $example): void {
                $actual = $filter->filter(
                    $example["value"]
                );
            }
        );
    }

    public function providerException(): array
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
