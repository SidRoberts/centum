<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsString;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsString
 */
final class IsStringCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsString();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerGood(): array
    {
        return [
            ["Sid Roberts"],
            [""],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsString();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
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
            [null],
            [new stdClass()],
        ];
    }
}
