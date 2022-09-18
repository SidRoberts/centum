<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsNull;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class IsNullCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [null],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not null."],
            $violations
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
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
