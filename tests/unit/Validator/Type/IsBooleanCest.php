<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsBoolean;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsBooleanCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

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
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [],
            ],

            [
                "value"    => false,
                "expected" => [],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not boolean.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not boolean.",
                ],
            ],
        ];
    }
}
