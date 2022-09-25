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

class IsInstanceOfCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsInstanceOf(
            FilterInterface::class
        );

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
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

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an instance of Centum\\Interfaces\\Filter\\FilterInterface."],
            $violations
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

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an object."],
            $violations
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
