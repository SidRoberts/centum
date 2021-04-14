<?php

namespace Tests\Validator;

use Centum\Validator\Alpha;
use Codeception\Example;
use Tests\UnitTester;

class AlphaCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

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
                "value"    => "SidRoberts",
                "expected" => [],
            ],

            [
                "value"    => "SidRoberts92",
                "expected" => [
                    "Value must only contain letters.",
                ],
            ],

            [
                "value"    => "##not.alphanumeric##",
                "expected" => [
                    "Value must only contain letters.",
                ],
            ],

            [
                "value"    => "This is a sentence.",
                "expected" => [
                    "Value must only contain letters.",
                ],
            ],

            [
                "value"    => "이것은 영숫자가 아닙니다.",
                "expected" => [
                    "Value must only contain letters.",
                ],
            ],
        ];
    }
}
