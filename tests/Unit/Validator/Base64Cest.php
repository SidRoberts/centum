<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Base64;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class Base64Cest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Base64();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
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

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [
                "Value is not a valid base64 string.",
            ],
            $violations
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



    public function testEmptyValue(UnitTester $I): void
    {
        $validator = new Base64();

        $violations = $validator->validate("");

        $I->assertCount(
            0,
            $violations
        );
    }
}
