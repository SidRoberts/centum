<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Alpha;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Alpha
 */
class AlphaCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["SidRoberts"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value must only contain letters."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["SidRoberts92"],
            ["##not.alphanumeric##"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

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
