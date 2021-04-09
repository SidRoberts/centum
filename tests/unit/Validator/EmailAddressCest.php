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

        if ($example["expected"]) {
            $I->assertTrue($actual);
        } else {
            $I->assertEquals(
                [
                    "Value is not an email address.",
                ],
                $actual
            );
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "sid@sidroberts.co.uk",
                "expected" => true,
            ],

            [
                "value"    => "not.an.email.address",
                "expected" => false,
            ],

            [
                "value"    => "not.an@@email.address",
                "expected" => false,
            ],
        ];
    }
}
