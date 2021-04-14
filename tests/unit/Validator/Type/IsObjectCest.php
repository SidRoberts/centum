<?php

namespace Tests\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsObject;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsObjectCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsObject();

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
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => [],
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => true,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => false,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => 123.456,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => 0,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => null,
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => [],
            ],

            [
                "value"    => (object) [],
                "expected" => [],
            ],

            [
                "value"    => $this,
                "expected" => [],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [],
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => [
                    "Value is not an object.",
                ],
            ],

            [
                "value"    => "",
                "expected" => [
                    "Value is not an object.",
                ],
            ],
        ];
    }
}
