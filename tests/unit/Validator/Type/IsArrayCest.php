<?php

namespace Tests\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsArray;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsArrayCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsArray();

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
                "expected" => [],
            ],

            [
                "value"    => [],
                "expected" => [],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => (object) [],
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => $this,
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not an array.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not an array.",
                ],
            ],
        ];
    }
}
