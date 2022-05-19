<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsObject;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsObjectCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsObject();

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
            new HtmlFormatter(),
            (object) [],
            $this,
            new stdClass(),
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
                        "Value is not an object.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
