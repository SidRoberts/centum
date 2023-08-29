<?php

namespace Tests\Unit\Validator\Type;

use Centum\Filter\String\Trim;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Filter\FilterInterface;
use Centum\Validator\Type\IsInstanceOf;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsInstanceOf
 */
class IsInstanceOfCest
{
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

    protected function providerNonObject(): array
    {
        return [
            ["just a string"],
            [123],
        ];
    }
}
