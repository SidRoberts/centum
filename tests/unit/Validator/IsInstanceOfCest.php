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

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not an instance of Centum\\Filter\\FilterInterface.",
                ],
                $actual
            );
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => new Trim(),
                "expected" => true,
            ],

            [
                "value"    => new HtmlFormatter(),
                "expected" => false,
            ],

            [
                "value"    => new stdClass(),
                "expected" => false,
            ],

            [
                "value"    => $this,
                "expected" => false,
            ],

            [
                "value"    => "just a string",
                "expected" => false,
            ],

            [
                "value"    => 123,
                "expected" => false,
            ],
        ];
    }
}
