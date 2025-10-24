<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsObject;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsObject
 */
final class IsObjectCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsObject::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsObject();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: object}>
     */
    protected function providerGood(): array
    {
        return [
            [new HtmlFormatter()],
            [(object) []],
            [$this],
            [new stdClass()],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsObject();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an object."]
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
            ["Sid Roberts"],
            [""],
        ];
    }
}
