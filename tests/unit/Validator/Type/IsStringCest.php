<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsString;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsStringCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsString();

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
            "Sid Roberts",
            "",
        ];

        $bad = [
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
