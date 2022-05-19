<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCallable;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsCallableCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [function () {
            }],
            ["is_callable"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a callable."],
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
            [123],
            [0],
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
