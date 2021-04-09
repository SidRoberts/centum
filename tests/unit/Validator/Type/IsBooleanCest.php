<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsBoolean;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsBooleanCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $actual = $validator->validate(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not boolean.",
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
                "expected" => true,
            ],

            [
                "value"    => false,
                "expected" => true,
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
                "expected" => false,
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
