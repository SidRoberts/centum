<?php

namespace Tests\Unit\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsInteger;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsInteger
 */
final class IsIntegerCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsInteger::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsInteger();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
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
            [null],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
