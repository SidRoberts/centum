<?php

namespace Tests\Unit\Validator;

use Centum\Validator\TimeZone;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class TimeZoneCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["Asia/Seoul"],
            ["UTC"],
            ["Europe/London"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a valid time zone."]
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



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Timezone();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    protected function providerNonString(): array
    {
        return [
            [123],
        ];
    }
}
