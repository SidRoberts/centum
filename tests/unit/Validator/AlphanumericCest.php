<?php

namespace Tests\Unit\Validator;

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
        $good = [
            "SidRoberts",
            "SidRoberts92",
        ];

        $bad = [
            "##not.alphanumeric##",
            "This is a sentence.",
            "이것은 영숫자가 아닙니다.",
        ];

        $good = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [],
                ];
            },
            $good
        );

        $bad = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not alphanumeric.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new Alphanumeric();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
