<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsNull;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsNullCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

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
            null,
        ];

        $bad = [
            [1,2,3],
            [],
            true,
            false,
            123.456,
            123,
            0,
            new stdClass(),
            "Sid Roberts",
            "",
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
                        "Value is not null.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
