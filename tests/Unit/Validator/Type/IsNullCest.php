<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsNull;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsNull
 */
final class IsNullCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsNull();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: null}>
     */
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not null."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [[1, 2, 3]],
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
