<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsNull;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsNullCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

        $actual = $validator->validate(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not null.",
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
                "expected" => false,
            ],

            [
                "value"    => 0,
                "expected" => false,
            ],

            [
                "value"    => null,
                "expected" => true,
            ],

            [
                "value"    => new stdClass(),
                "expected" => false,
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
