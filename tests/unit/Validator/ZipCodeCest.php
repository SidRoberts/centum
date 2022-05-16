<?php

namespace Tests\Unit\Validator;

use Centum\Validator\ZipCode;
use Codeception\Example;
use Tests\UnitTester;

class ZipCodeCest
{
    /**
     * @dataProvider validZipCodesProvider
     */
    public function testValidZipCodes(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [],
            $actual,
        );
    }

    public function validZipCodesProvider(): array
    {
        return [
            [90210],
            ["90210"],
            ["10036-6600"],
        ];
    }



    /**
     * @dataProvider invalidZipCodesProvider
     */
    public function testInvalidZipCodes(UnitTester $I, Example $example): void
    {
        $validator = new ZipCode();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [
                "Value is not a valid zip code.",
            ],
            $actual
        );
    }

    public function invalidZipCodesProvider(): array
    {
        return [
            ["not a valid zip code"],
        ];
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new ZipCode();

        $actual = $validator->validate([]);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
