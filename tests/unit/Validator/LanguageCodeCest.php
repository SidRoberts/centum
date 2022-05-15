<?php

namespace Tests\Unit\Validator;

use Centum\Validator\LanguageCode;
use Codeception\Example;
use Tests\UnitTester;

class LanguageCodeCest
{
    /**
     * @dataProvider validLanguageCodesProvider
     */
    public function testValidLanguageCodes(UnitTester $I, Example $example): void
    {
        $validator = new LanguageCode();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [],
            $actual,
        );
    }

    public function validLanguageCodesProvider(): array
    {
        return [
            ["en-GB"],
            ["ko-KR"],
        ];
    }



    /**
     * @dataProvider invalidLanguageCodesProvider
     */
    public function testInvalidLanguageCodes(UnitTester $I, Example $example): void
    {
        $validator = new LanguageCode();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [
                "Value is not an ISO language code.",
            ],
            $actual
        );
    }

    public function invalidLanguageCodesProvider(): array
    {
        return [
            ["english"],
        ];
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new LanguageCode();

        $actual = $validator->validate([]);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
