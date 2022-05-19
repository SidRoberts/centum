<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCharacter;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCharacterCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $actual = $validator->validate(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider(): array
    {
        $good = [
            "S",
            "0",
            "/",
        ];

        $bad1 = [
            "Sid",
            "",
            "123",
        ];

        $bad2 = [
            [1,2,3],
            [],
            true,
            false,
            123.456,
            123,
            0,
            null,
            new stdClass(),
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

        $bad1 = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not a character.",
                    ],
                ];
            },
            $bad1
        );

        $bad2 = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not a string.",
                    ],
                ];
            },
            $bad2
        );

        return array_merge($good, $bad1, $bad2);
    }
}
