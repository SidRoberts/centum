<?php

namespace Tests\Unit\Validator;

use Centum\Validator\ZipCode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\ZipCode
 */
final class ZipCodeCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            [90210],
            ["90210"],
            ["10036-6600"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a valid zip code."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["not a valid zip code"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

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
