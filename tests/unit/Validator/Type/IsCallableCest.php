<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCallable;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCallableCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

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
            function () {
            },
            "is_callable",
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
                        "Value is not a callable.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
