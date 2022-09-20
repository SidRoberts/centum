<?php

namespace Tests\Unit\Validator;

use Centum\Validator\InArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class InArrayCest
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

        $validator = new InArray($allowedValues);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["Monday"],
            ["Tuesday"],
            ["Wednesday"],
            ["Thursday"],
            ["Friday"],
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

        $validator = new InArray($allowedValues);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not in the list of allowed values."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Saturday"],
            ["Sunday"],
        ];
    }
}
