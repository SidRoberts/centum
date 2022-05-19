<?php

namespace Tests\Unit\Validator;

use Centum\Validator\LanguageCode;
use Codeception\Example;
use Tests\UnitTester;

class LanguageCodeCest
{
    /**
     * @dataProvider providerGood
     */
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



    /**
     * @dataProvider providerBad
     */
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



    /**
     * @dataProvider providerNonString
     */
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
