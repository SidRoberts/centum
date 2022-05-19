<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsInteger;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsIntegerCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [123],
            [0],
            ["1"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an integer."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [[1,2,3]],
            [[]],
            [true],
            [false],
            [123.456],
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
