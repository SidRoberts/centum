<?php

namespace Tests\Validator;

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

    public function provider(): array
    {
        return [
            [
                "value"    => "sid@sidroberts.co.uk",
                "expected" => [],
            ],

            [
                "value"    => "not.an.email.address",
                "expected" => [
                    "Value is not an email address.",
                ],
            ],

            [
                "value"    => "not.an@@email.address",
                "expected" => [
                    "Value is not an email address.",
                ],
            ],
        ];
    }
}
