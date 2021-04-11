<?php

namespace Tests\Validator\Type;

use Centum\Validator\Type\IsString;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsStringCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new IsString();

        $actual = $validator->validate(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not a string.",
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
                "expected" => false,
            ],

            [
                "value"    => new stdClass(),
                "expected" => false,
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => true,
            ],

            [
                "value"    => "",
                "expected" => true,
            ],
        ];
    }
}
