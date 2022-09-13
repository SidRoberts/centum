<?php

namespace Tests\Unit\Filter;

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

        /** @var mixed */
        $value = $example["value"];

        /** @var mixed */
        $actual = $filter->filter($value);

        if ($example["expected"]) {
            $I->assertEquals(
                $example["value"],
                $actual
            );
        } else {
            $I->assertNull($actual);
        }
    }

    protected function provider(): array
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
