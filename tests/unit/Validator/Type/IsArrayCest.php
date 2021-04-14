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

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not an array.",
                ],
                $actual
            );
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => [1,2,3],
                "expected" => true,
            ],

            [
                "value"    => [],
                "expected" => true,
            ],

            [
                "value"    => true,
                "expected" => false,
            ],

            [
                "value"    => false,
                "expected" => false,
            ],

            [
                "value"    => 123.456,
                "expected" => false,
            ],

            [
                "value"    => 123,
                "expected" => false,
            ],

            [
                "value"    => 0,
                "expected" => false,
            ],

            [
                "value"    => null,
                "expected" => false,
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => false,
            ],

            [
                "value"    => (object) [],
                "expected" => false,
            ],

            [
                "value"    => $this,
                "expected" => false,
            ],

            [
                "value"    => new stdClass(),
                "expected" => false,
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => false,
            ],

            [
                "value"    => "",
                "expected" => false,
            ],
        ];
    }
}
