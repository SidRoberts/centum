<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Alpha;
use Codeception\Example;
use Tests\UnitTester;

class AlphaCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

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
        ];

        $bad = [
            "SidRoberts92",
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
                        "Value must only contain letters.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new Alpha();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
