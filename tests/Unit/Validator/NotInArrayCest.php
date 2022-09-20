<?php

namespace Tests\Unit\Validator;

use Centum\Validator\NotInArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class NotInArrayCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $allowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new NotInArray($allowedValues);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["Saturday"],
            ["Sunday"],
            [""],
            [false],
            [null],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $allowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new NotInArray($allowedValues);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is in the list of disallowed values."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Monday"],
            ["Tuesday"],
            ["Wednesday"],
            ["Thursday"],
            ["Friday"],
        ];
    }
}
