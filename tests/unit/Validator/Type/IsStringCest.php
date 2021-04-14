<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsString;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsStringCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsString();

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
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not a string.",
                ],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [],
            ],

            [
                "value"    => "",
                "expected" => [],
            ],
        ];
    }
}
