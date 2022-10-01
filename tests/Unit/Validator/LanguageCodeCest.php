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

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an ISO language code."]
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    protected function providerNonString(): array
    {
        return [
            [[]],
        ];
    }
}
