<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Group;
use Centum\Filter\String\Prefix;
use Centum\Filter\String\ToLower;
use Centum\Filter\String\Trim;
use Codeception\Example;
use Tests\UnitTester;

class GroupCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Group();

        $filter->addFilter(
            new ToLower()
        );

        $filter->addFilter(
            new Trim()
        );

        $filter->addFilter(
            new Prefix("ABC-")
        );

        $actual = $filter->filter(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider(): array
    {
        return [
            [
                "value"    => "  SeNtEnCe   ",
                "expected" => "ABC-sentence",
            ],
        ];
    }

    public function getFilters(UnitTester $I): void
    {
        $filter1 = new ToLower();
        $filter2 = new Trim();
        $filter3 = new Prefix("ABC-");



        $filter = new Group();

        $filter->addFilter($filter1);

        $filter->addFilter($filter2);

        $filter->addFilter($filter3);



        $filters = $filter->getFilters();

        $I->assertEquals(
            [
                $filter1,
                $filter2,
                $filter3,
            ],
            $filters
        );
    }
}
