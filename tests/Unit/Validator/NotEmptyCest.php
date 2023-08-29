<?php

namespace Tests\Unit\Validator;

use Centum\Validator\NotEmpty;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\NotEmpty
 */
class NotEmptyCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new NotEmpty();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
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



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new NotEmpty();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is required and can't be empty."]
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
