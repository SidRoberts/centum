<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsBoolean;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsBooleanCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

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
            true,
            false,
        ];

        $bad = [
            [1,2,3],
            [],
            123.456,
            123,
            0,
            null,
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
                        "Value is not boolean.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
