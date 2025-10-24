<?php

namespace Tests\Unit\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsBoolean;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsBoolean
 */
final class IsBooleanCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsBoolean::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsBoolean();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: bool}>
     */
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

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [[1, 2, 3]],
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
