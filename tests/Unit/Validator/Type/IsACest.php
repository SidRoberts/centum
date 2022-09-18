<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsA;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use LogicException;
use stdClass;
use Tests\Support\UnitTester;
use Throwable;

class IsACest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsA(Throwable::class);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [new Exception()],
            [new LogicException()],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsA(Throwable::class);

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not Throwable or a descendent of it."],
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
