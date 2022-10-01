<?php

namespace Tests\Unit\Validator;

use Centum\Validator\RegularExpression;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class RegularExpressionCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["abc1"],
            ["abc2"],
            ["abc3"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value does not match '/^[a-z]{3}[0-9]$/'."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Sid"],
            [""],
            ["ABC1"],
            ["123"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new RegularExpression("/^[a-z]{3}[0-9]$/");

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
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
