<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsInteger;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsIntegerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

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
            123,
            0,
            "1",
        ];

        $bad = [
            [1,2,3],
            [],
            true,
            false,
            123.456,
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
                        "Value is not an integer.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
