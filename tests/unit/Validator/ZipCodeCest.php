<?php

namespace Tests\Unit\Validator;

use Centum\Validator\ZipCode;
use Codeception\Example;
use Tests\UnitTester;

class ZipCodeCest
{
    /**
     * @dataProvider providerGood
     */
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



    /**
     * @dataProvider providerBad
     */
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



    /**
     * @dataProvider providerNonString
     */
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
