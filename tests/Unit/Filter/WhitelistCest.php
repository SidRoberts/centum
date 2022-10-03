<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Whitelist;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class WhitelistCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        /** @var bool */
        $strict = $example["strict"];

        $filter = new Whitelist(
            [
                "Busan",
                "Yeosu",
                1,
                false,
                [1,2,3],
            ],
            $strict
        );

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    protected function provider(): array
    {
        return [
            [
                "input"  => "Busan",
                "strict" => true,
                "output" => "Busan",
            ],

            [
                "input"  => 1,
                "strict" => true,
                "output" => 1,
            ],

            [
                "input"  => "1",
                "strict" => true,
                "output" => null,
            ],

            [
                "input"  => "1",
                "strict" => false,
                "output" => "1",
            ],

            [
                "input"  => true,
                "strict" => true,
                "output" => null,
            ],

            [
                "input"  => [1,2,3],
                "strict" => true,
                "output" => [1,2,3],
            ],

            [
                "input"  => [],
                "strict" => true,
                "output" => null,
            ],
        ];
    }
}
