<?php

namespace Tests\Unit\Validator;

use Centum\Validator\EmailAddress;
use Codeception\Example;
use Tests\UnitTester;

class EmailAddressCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["sid@sidroberts.co.uk"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an email address."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["not.an.email.address"],
            ["not.an@@email.address"],
        ];
    }



    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a string."],
            $violations
        );
    }

    protected function providerNonString(): array
    {
        return [
            [123],
        ];
    }
}
