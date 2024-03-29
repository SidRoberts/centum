<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Base64;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Base64
 */
final class Base64Cest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Base64();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["SGVsbG8="],
            ["6re46rKMIOyVhOuLiOyVvA=="],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Base64();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a valid base64 string."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["notAvalidBase64string"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Base64();

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



    public function testEmptyValue(UnitTester $I): void
    {
        $validator = new Base64();

        $I->seeValidatorPasses(
            $validator,
            ""
        );
    }
}
