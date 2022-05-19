<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsArray;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsArrayCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsArray();

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
            [1,2,3],
            [],
        ];

        $bad = [
            true,
            false,
            123.456,
            123,
            0,
            null,
            new HtmlFormatter(),
            (object) [],
            $this,
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
                        "Value is not an array.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
