<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCharacter;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCharacterCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["S"],
            ["0"],
            ["/"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a character."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Sid"],
            [""],
            ["123"],
        ];
    }


    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

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
