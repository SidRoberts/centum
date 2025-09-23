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

    /**
     * @return array<array{0: string|int}>
     */
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

    /**
     * @return array<array{0: string}>
     */
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
