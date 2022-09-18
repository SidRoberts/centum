<?php

namespace Tests\Unit\Validator;

use Centum\Validator\ZipCode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class ZipCodeCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
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

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a valid zip code."],
            $violations
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
