<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsInteger;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsInteger
 */
class IsIntegerCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            [123],
            [0],
            ["1"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an integer."]
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
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
