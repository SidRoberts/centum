<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Validator\Type\IsIterable;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsIterableCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsIterable();

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
            [1, 2, 3],
            new ArrayIterator([1, 2, 3]),
            (function () { yield 1; })(),
        ];

        $bad = [
            1,
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
                        "Value is not iterable.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
