<?php

namespace Tests\Unit\Validator;

use Centum\Validator\RegularExpression;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class RegularExpressionCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["abc1"],
            ["abc2"],
            ["abc3"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value does not match '/^[a-z]{3}[0-9]$/'."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Sid"],
            [""],
            ["ABC1"],
            ["123"],
        ];
    }


    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

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
            [[1,2,3]],
            [[]],
            [true],
            [false],
            [123.456],
            [123],
            [0],
            [null],
            [new stdClass()],
        ];
    }
}
