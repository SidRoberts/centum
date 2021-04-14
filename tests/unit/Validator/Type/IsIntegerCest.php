<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsInteger;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsIntegerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $actual = $validator->validate(
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
                "value"    => [1,2,3],
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [],
            ],

            [
                "value"    => 0,
                "expected" => [],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => "1",
                "expected" => [],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not an integer.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not an integer.",
                ],
            ],
        ];
    }
}
