<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Group;
use Centum\Filter\String\Prefix;
use Centum\Filter\String\ToLower;
use Centum\Filter\String\Trim;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Group
 */
final class GroupCest
{
    #[DataProvider("provider")]
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



        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: string, output: string}>
     */
    protected function provider(): array
    {
        return [
            [
                "input"  => "  SeNtEnCe   ",
                "output" => "ABC-sentence",
            ],
        ];
    }



    public function testGetFilters(UnitTester $I): void
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
