<?php

namespace Tests\Filter;

use Centum\Filter\StringTrim;
use Codeception\Example;
use Tests\UnitTester;

class StringTrimCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new StringTrim();

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
