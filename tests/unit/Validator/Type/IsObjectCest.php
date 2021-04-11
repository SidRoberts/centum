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

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not an object.",
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
                "expected" => true,
            ],

            [
                "value"    => (object) [],
                "expected" => true,
            ],

            [
                "value"    => $this,
                "expected" => true,
            ],

            [
                "value"    => new stdClass(),
                "expected" => true,
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
