<?php

namespace Tests\Unit\Validator\Type;

use Centum\Filter\String\Trim;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Filter\FilterInterface;
use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsInstanceOf;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsInstanceOf
 */
final class IsInstanceOfCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsInstanceOf::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsInstanceOf(
            FilterInterface::class
        );

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: FilterInterface}>
     */
    protected function providerGood(): array
    {
        return [
            [new Trim()],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsInstanceOf(
            FilterInterface::class
        );

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an instance of Centum\\Interfaces\\Filter\\FilterInterface."]
        );
    }

    /**
     * @return array<array{0: object}>
     */
    protected function providerBad(): array
    {
        return [
            [new HtmlFormatter()],
            [new stdClass()],
            [$this],
        ];
    }



    #[DataProvider("providerNonObject")]
    public function testNonObject(UnitTester $I, Example $example): void
    {
        $validator = new IsInstanceOf(
            FilterInterface::class
        );

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not an object."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerNonObject(): array
    {
        return [
            ["just a string"],
            [123],
        ];
    }
}
