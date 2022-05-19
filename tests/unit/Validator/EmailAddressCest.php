<?php

namespace Tests\Unit\Validator;

use Centum\Validator\EmailAddress;
use Codeception\Example;
use Tests\UnitTester;

class EmailAddressCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

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
            "sid@sidroberts.co.uk",
        ];

        $bad = [
            "not.an.email.address",
            "not.an@@email.address",
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
                        "Value is not an email address.",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new EmailAddress();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
