<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsScalar;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsScalarCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsScalar();

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
            true,
            false,
            123.456,
            123,
            0,
            "Sid Roberts",
            "",
        ];

        $bad = [
            [1,2,3],
            [],
            null,
            new HtmlFormatter(),
            (object) [],
            $this,
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
                        "Value is not a scalar.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
