<?php

namespace Tests\Unit\Validator;

use Centum\Validator\EmailAddress;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\EmailAddress
 */
final class EmailAddressCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["sid@sidroberts.co.uk"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an email address."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["not.an.email.address"],
            ["not.an@@email.address"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new EmailAddress();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    protected function providerNonString(): array
    {
        return [
            [123],
        ];
    }
}
