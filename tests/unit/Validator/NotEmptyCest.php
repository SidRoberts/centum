<?php

namespace Tests\Unit\Validator;

use Centum\Validator\NotEmpty;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class NotEmptyCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new NotEmpty();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [[1,2,3]],
            [true],
            [123.456],
            [123],
            [new stdClass()],
            ["Sid Roberts"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new NotEmpty();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is required and can't be empty."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [[]],
            [false],
            [0],
            [""],
            [null],
        ];
    }
}
