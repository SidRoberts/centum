<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsBoolean;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsBooleanCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [true],
            [false],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not boolean."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [[1,2,3]],
            [[]],
            [123.456],
            [123],
            [0],
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
