<?php

namespace Tests\Validator;

use Centum\Validator\Callback;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class CallbackCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Callback(
            function (mixed $value): array {
                if (!is_string($value)) {
                    return [
                        "Value is not a string.",
                    ];
                }

                return [];
            }
        );

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
            "안녕",
            "123",
        ];

        $bad = [
            true,
            null,
            123,
            [],
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

        $bad = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not a string.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
