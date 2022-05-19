<?php

namespace Tests\Unit\Validator;

use Centum\Validator\TimeZone;
use Codeception\Example;
use Tests\UnitTester;

class TimeZoneCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["Asia/Seoul"],
            ["UTC"],
            ["Europe/London"],
        ];
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a valid time zone."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["SidRoberts92"],
            ["NotReal/TimeZone"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

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
