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

/**
 * @covers \Centum\Validator\Type\IsA
 */
final class IsACest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsA(Throwable::class);

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: Throwable}>
     */
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not Throwable or a descendent of it."]
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
