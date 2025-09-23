<?php

namespace Tests\Unit\Filter\Cest;

use Centum\Filter\Cast\ToInteger;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Cast\ToInteger
 */
final class ToIntegerCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $filter = new ToInteger();

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: mixed, output: int}>
     */
    protected function providerGood(): array
    {
        return [
            [
                "input"  => 123,
                "output" => 123,
            ],

            [
                "input"  => "123",
                "output" => 123,
            ],

            [
                "input"  => 123.456,
                "output" => 123,
            ],

            [
                "input"  => "",
                "output" => 0,
            ],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $filter = new ToInteger();

        $expectedThrowable = new InvalidArgumentException(
            "Value must be a resource, a scalar, or null."
        );

        $I->expectFilterThrowable(
            $expectedThrowable,
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [
                "input"=> new stdClass(),
            ],

            [
                "input"=> function () {},
            ],
        ];
    }
}
