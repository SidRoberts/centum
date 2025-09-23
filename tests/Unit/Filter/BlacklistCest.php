<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Blacklist;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Blacklist
 */
final class BlacklistCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        /** @var bool */
        $strict = $example["strict"];

        $filter = new Blacklist(
            [
                "Busan",
                "Yeosu",
                1,
                false,
                [1, 2, 3],
            ],
            $strict
        );

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: mixed, strict: bool, output: mixed}>
     */
    protected function provider(): array
    {
        return [
            [
                "input"  => "Busan",
                "strict" => true,
                "output" => null,
            ],

            [
                "input"  => 1,
                "strict" => true,
                "output" => null,
            ],

            [
                "input"  => "1",
                "strict" => true,
                "output" => "1",
            ],

            [
                "input"  => "1",
                "strict" => false,
                "output" => null,
            ],

            [
                "input"  => true,
                "strict" => true,
                "output" => true,
            ],

            [
                "input"  => [1, 2, 3],
                "strict" => true,
                "output" => null,
            ],

            [
                "input"  => [],
                "strict" => true,
                "output" => [],
            ],
        ];
    }
}
