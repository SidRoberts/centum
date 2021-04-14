<?php

namespace Tests\Validator;

use Centum\Validator\Alphanumeric;
use Codeception\Example;
use Tests\UnitTester;

class AlphanumericCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

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
                "value"    => "SidRoberts",
                "expected" => [],
            ],

            [
                "value"    => "SidRoberts92",
                "expected" => [],
            ],

            [
                "value"    => "##not.alphanumeric##",
                "expected" => [
                    "Value is not alphanumeric.",
                ],
            ],

            [
                "value"    => "This is a sentence.",
                "expected" => [
                    "Value is not alphanumeric.",
                ],
            ],

            [
                "value"    => "이것은 영숫자가 아닙니다.",
                "expected" => [
                    "Value is not alphanumeric.",
                ],
            ],
        ];
    }
}
