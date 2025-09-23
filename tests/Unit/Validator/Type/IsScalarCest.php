<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsScalar;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsScalar
 */
final class IsScalarCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsScalar();

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
            [true],
            [false],
            [123.456],
            [123],
            [0],
            ["Sid Roberts"],
            [""],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsScalar();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a scalar."]
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
            [null],
            [new HtmlFormatter()],
            [(object) []],
            [$this],
            [new stdClass()],
        ];
    }
}
