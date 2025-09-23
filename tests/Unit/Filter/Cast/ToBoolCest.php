<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToBool;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Cast\ToBool
 */
final class ToBoolCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToBool();

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: mixed, output: bool}>
     */
    protected function provider(): array
    {
        return [
            [
                "input"  => [1, 2, 3],
                "output" => true,
            ],

            [
                "input"  => [],
                "output" => false,
            ],

            [
                "input"  => true,
                "output" => true,
            ],

            [
                "input"  => false,
                "output" => false,
            ],

            [
                "input"  => 123.456,
                "output" => true,
            ],

            [
                "input"  => 123,
                "output" => true,
            ],

            [
                "input"  => 0,
                "output" => false,
            ],

            [
                "input"  => null,
                "output" => false,
            ],

            [
                "input"  => new stdClass(),
                "output" => true,
            ],

            [
                "input"  => "Sid Roberts",
                "output" => true,
            ],

            [
                "input"  => "",
                "output" => false,
            ],
        ];
    }
}
