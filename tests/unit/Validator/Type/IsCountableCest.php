<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Validator\Type\IsCountable;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCountableCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsCountable();

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
            new ArrayIterator(['foo', 'bar', 'baz']),
            new ArrayIterator(),
        ];

        $bad = [
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
                        "Value is not countable.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
