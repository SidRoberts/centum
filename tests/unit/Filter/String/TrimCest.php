<?php

namespace Tests\Filter\String;

use Centum\Filter\String\Trim;
use Codeception\Example;
use Tests\UnitTester;

class TrimCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Trim();

        $actual = $filter->filter(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function provider(): array
    {
        return [
            [
                "value"    => "Sid",
                "expected" => "Sid",
            ],

            [
                "value"    => "  Sid  ",
                "expected" => "Sid",
            ],

            [
                "value"    => "   ",
                "expected" => "",
            ],

            [
                "value"    => "",
                "expected" => "",
            ],
        ];
    }
}
