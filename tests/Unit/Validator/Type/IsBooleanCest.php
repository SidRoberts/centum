<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsBoolean;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsBoolean
 */
class IsBooleanCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            [true],
            [false],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not boolean."]
        );
    }

    protected function providerBad(): array
    {
        return [
            [[1,2,3]],
            [[]],
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
