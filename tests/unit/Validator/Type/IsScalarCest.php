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

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not a scalar.",
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
                "expected" => false,
            ],

            [
                "value"    => [],
                "expected" => false,
            ],

            [
                "value"    => true,
                "expected" => true,
            ],

            [
                "value"    => false,
                "expected" => true,
            ],

            [
                "value"    => 123.456,
                "expected" => true,
            ],

            [
                "value"    => 123,
                "expected" => true,
            ],

            [
                "value"    => 0,
                "expected" => true,
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
                "expected" => true,
            ],

            [
                "value"    => "",
                "expected" => true,
            ],
        ];
    }
}
