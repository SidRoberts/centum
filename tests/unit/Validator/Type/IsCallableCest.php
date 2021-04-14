<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsCallable;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCallableCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

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
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not a callable.",
                ],
            ],

            [
                "value"    => function () { },
                "expected" => [],
            ],

            [
                "value"    => "is_callable",
                "expected" => [],
            ],
        ];
    }
}
