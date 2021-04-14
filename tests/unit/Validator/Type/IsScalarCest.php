<?php

namespace Tests\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsScalar;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsScalarCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsScalar();

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
                    "Value is not a scalar.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not a scalar.",
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
                "expected" => [],
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
                    "Value is not a scalar.",
                ],
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => [
                    "Value is not a scalar.",
                ],
            ],

            [
                "value"    => (object) [],
                "expected" => [
                    "Value is not a scalar.",
                ],
            ],

            [
                "value"    => $this,
                "expected" => [
                    "Value is not a scalar.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not a scalar.",
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
