<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsInteger;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsIntegerCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $actual = $validator->validate(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not an integer.",
                ],
                $actual
            );
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => [1,2,3],
                "expected" => false,
            ],

            [
                "value"    => [],
                "expected" => false,
            ],

            [
                "value"    => true,
                "expected" => false,
            ],

            [
                "value"    => false,
                "expected" => false,
            ],

            [
                "value"    => 123.456,
                "expected" => false,
            ],

            [
                "value"    => 123,
                "expected" => true,
            ],

            [
                "value"    => 0,
                "expected" => true,
            ],

            [
                "value"    => null,
                "expected" => false,
            ],

            [
                "value"    => new stdClass(),
                "expected" => false,
            ],

            [
                "value"    => "1",
                "expected" => true,
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => false,
            ],

            [
                "value"    => "",
                "expected" => false,
            ],
        ];
    }
}
