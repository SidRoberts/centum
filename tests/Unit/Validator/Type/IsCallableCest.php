<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCallable;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsCallable
 */
class IsCallableCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            [function () {
            }],
            ["is_callable"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsCallable();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a callable."]
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
            [123],
            [0],
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
