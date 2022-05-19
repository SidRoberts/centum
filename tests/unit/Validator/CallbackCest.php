<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Callback;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class CallbackCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Callback(
            function (mixed $value): array {
                if (!is_string($value)) {
                    return [
                        "Value is not a string.",
                    ];
                }

                return [];
            }
        );

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["SidRoberts"],
            ["안녕"],
            ["123"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Callback(
            function (mixed $value): array {
                if (!is_string($value)) {
                    return [
                        "Value is not a string.",
                    ];
                }

                return [];
            }
        );

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a string."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [true],
            [null],
            [123],
            [[]],
            [new stdClass()],
        ];
    }
}
