<?php

namespace Tests\Unit\Paginator;

use Centum\Paginator\Data\ArrayData;
use Centum\Paginator\Exception\InvalidTotalException;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class ArrayDataCest
{
    public function test(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100),
            100
        );

        $I->assertEquals(
            range(1, 100),
            $data->toArray()
        );

        $I->assertEquals(
            100,
            $data->getTotal()
        );
    }



    #[DataProvider("providerImpossibleTotal")]
    public function testImpossibleTotal(UnitTester $I, Example $example): void
    {
        /** @var int */
        $total = $example[0];

        $I->expectThrowable(
            new InvalidTotalException($total),
            function () use ($total): void {
                new ArrayData(
                    range(1, 100),
                    $total
                );
            }
        );
    }

    protected function providerImpossibleTotal(): array
    {
        return [
            [-1],
        ];
    }
}
