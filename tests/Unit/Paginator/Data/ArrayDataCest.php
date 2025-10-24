<?php

namespace Tests\Unit\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Paginator\Data\ArrayData;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Paginator\Data\ArrayData
 */
final class ArrayDataCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $data = $I->mock(ArrayData::class);

        $I->assertInstanceOf(DataInterface::class, $data);
    }



    public function testToArray(UnitTester $I): void
    {
        $array = range(1, 100);

        $data = new ArrayData(
            $array
        );

        $I->assertEquals(
            $array,
            $data->toArray()
        );
    }



    public function testGetTotal(UnitTester $I): void
    {
        $array = range(1, 100);

        $data = new ArrayData(
            $array
        );

        $I->assertEquals(
            100,
            $data->getTotal()
        );
    }



    #[DataProvider("providerSlice")]
    public function testSlice(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        /** @var array */
        $expected = $example["expected"];

        /** @var int */
        $offset = $example["offset"];

        /** @var int */
        $length = $example["length"];

        $I->assertEquals(
            $expected,
            $data->slice($offset, $length)
        );
    }

    /**
     * @return array<array{offset: int, length: int, expected: array}>
     */
    protected function providerSlice(): array
    {
        return [
            [
                "offset"   => 34,
                "length"   => 10,
                "expected" => range(35, 44),
            ],

            [
                "offset"   => 99,
                "length"   => 10,
                "expected" => [100],
            ],
        ];
    }
}
