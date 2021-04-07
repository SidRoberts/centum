<?php

namespace Tests\Filter;

use Centum\Filter\Whitelist;
use Codeception\Example;
use Tests\UnitTester;

class WhitelistCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Whitelist(
            [
                "Busan",
                "Yeosu",
                1,
                false,
                [1,2,3],
            ],
            $example["strict"]
        );

        $actual = $filter->filter(
            $example["value"]
        );

        if ($example["expected"]) {
            $I->assertEquals(
                $example["value"],
                $actual
            );
        } else {
            $I->assertNull($actual);
        }
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "Busan",
                "strict"   => true,
                "expected" => true,
            ],

            [
                "value"    => 1,
                "strict"   => true,
                "expected" => true,
            ],

            [
                "value"    => "1",
                "strict"   => true,
                "expected" => false,
            ],

            [
                "value"    => "1",
                "strict"   => false,
                "expected" => true,
            ],

            [
                "value"    => true,
                "strict"   => true,
                "expected" => false,
            ],

            [
                "value"    => [1,2,3],
                "strict"   => true,
                "expected" => true,
            ],

            [
                "value"    => [],
                "strict"   => true,
                "expected" => false,
            ],
        ];
    }
}
