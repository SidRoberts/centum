<?php

namespace Tests\Unit\Validator;

use Centum\Validator\LanguageCode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\LanguageCode
 */
final class LanguageCodeCest
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

    /**
     * @return array<array{0: string}>
     */
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

    /**
     * @return array<array{0: string}>
     */
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

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerNonString(): array
    {
        return [
            [[]],
        ];
    }
}
