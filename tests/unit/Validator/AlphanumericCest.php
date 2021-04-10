<?php

namespace Tests\Validator;

use Centum\Validator\Alphanumeric;
use Codeception\Example;
use Tests\UnitTester;

class AlphanumericCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

        $actual = $validator->validate(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not alphanumeric.",
                ],
                $actual
            );
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "SidRoberts",
                "expected" => true,
            ],

            [
                "value"    => "SidRoberts92",
                "expected" => true,
            ],

            [
                "value"    => "##not.alphanumeric##",
                "expected" => false,
            ],

            [
                "value"    => "This is a sentence.",
                "expected" => false,
            ],

            [
                "value"    => "이것은 영숫자가 아닙니다.",
                "expected" => false,
            ],
        ];
    }
}
