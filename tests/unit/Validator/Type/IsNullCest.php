<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsNull;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsNullCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

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
                    "Value is not null.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not null.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not null.",
                ],
            ],
        ];
    }
}
