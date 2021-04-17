<?php

namespace Tests\Validator\Type;

use Centum\Filter\FilterInterface;
use Centum\Filter\String\Trim;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsInstanceOf;
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

        $badObjects = [
            new HtmlFormatter(),
            new stdClass(),
            $this,
        ];

        $bad = [
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

        $badObjects = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not an instance of Centum\\Filter\\FilterInterface.",
                    ],
                ];
            },
            $badObjects
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

        return array_merge($good, $badObjects, $bad);
    }
}
