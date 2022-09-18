<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class IsArrayCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsArray();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

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

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not an array."],
            $violations
        );
    }

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
