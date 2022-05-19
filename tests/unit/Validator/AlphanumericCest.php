<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Alphanumeric;
use Codeception\Example;
use Tests\UnitTester;

class AlphanumericCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["SidRoberts"],
            ["SidRoberts92"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not alphanumeric."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["##not.alphanumeric##"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

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
            [123],
        ];
    }
}
