<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsArray
 */
final class IsArrayCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsArray::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsArray();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: array}>
     */
    protected function providerGood(): array
    {
        return [
            [[1, 2, 3]],
            [[]],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsArray();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an array."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [true],
            [false],
            [123.456],
            [123],
            [0],
            [null],
            [new HtmlFormatter()],
            [(object) []],
            [$this],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
