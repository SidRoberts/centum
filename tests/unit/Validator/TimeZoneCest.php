<?php

namespace Tests\Unit\Validator;

use Centum\Validator\TimeZone;
use Codeception\Example;
use Tests\UnitTester;

class TimeZoneCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new TimeZone();

        $actual = $validator->validate(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider(): array
    {
        $good = [
            "Asia/Seoul",
            "UTC",
            "Europe/London",
        ];

        $bad = [
            "SidRoberts92",
            "NotReal/TimeZone",
            "This is a sentence.",
            "이것은 영숫자가 아닙니다.",
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

        $bad = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "Value is not a valid time zone.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new TimeZone();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
