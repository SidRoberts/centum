<?php

namespace Tests\Validator;

use Centum\Filter\FilterInterface;
use Centum\Filter\String\Trim;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\IsInstanceOf;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsInstanceOfCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsInstanceOf(
            FilterInterface::class
        );

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
            new Trim(),
        ];

        $bad = [
            new HtmlFormatter(),
            new stdClass(),
            $this,
            "just a string",
            123,
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
                        "Value is not an instance of Centum\\Filter\\FilterInterface.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
