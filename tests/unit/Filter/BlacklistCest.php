<?php

namespace Tests\Filter;

use Centum\Filter\Blacklist;
use Codeception\Example;
use Tests\UnitTester;

class BlacklistCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Blacklist(
            [
                "Busan",
                "Yeosu",
                1,
                false,
                [1,2,3]
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
                "expected" => false,
            ],

            [
                "value"    => 1,
                "strict"   => true,
                "expected" => false,
            ],

            [
                "value"    => "1",
                "strict"   => true,
                "expected" => true,
            ],

            [
                "value"    => "1",
                "strict"   => false,
                "expected" => false,
            ],

            [
                "value"    => true,
                "strict"   => true,
                "expected" => true,
            ],

            [
                "value"    => [1,2,3],
                "strict"   => true,
                "expected" => false,
            ],

            [
                "value"    => [],
                "strict"   => true,
                "expected" => true,
            ],
        ];
    }
}