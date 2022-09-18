<?php

namespace Tests\Unit\Validator;

use Centum\Validator\LanguageCode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class LanguageCodeCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new LanguageCode();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["en-GB"],
            ["ko-KR"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new LanguageCode();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an ISO language code."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["english"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new LanguageCode();

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
            [[]],
        ];
    }
}
