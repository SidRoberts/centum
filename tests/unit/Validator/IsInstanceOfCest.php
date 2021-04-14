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
        return [
            [
                "value"    => new Trim(),
                "expected" => [],
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
            ],

            [
                "value"    => new stdClass(),
                "expected" => [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
            ],

            [
                "value"    => $this,
                "expected" => [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
            ],

            [
                "value"    => "just a string",
                "expected" => [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
            ],

            [
                "value"    => 123,
                "expected" => [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
            ],
        ];
    }
}
