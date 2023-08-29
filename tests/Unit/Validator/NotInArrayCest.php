<?php

namespace Tests\Unit\Validator;

use Centum\Validator\NotInArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\NotInArray
 */
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

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is in the list of disallowed values."]
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
