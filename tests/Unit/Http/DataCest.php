<?php

namespace Tests\Http;

use Centum\Http\Data;
use OutOfRangeException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Data
 */
final class DataCest
{
    public function testGet(UnitTester $I): void
    {
        $data = new Data(
            [
                "key1" => "value1",
                "key2" => null,
            ]
        );

        $I->assertEquals(
            "value1",
            $data->get("key1")
        );

        $I->assertNull(
            $data->get("key2")
        );

        $I->expectThrowable(
            OutOfRangeException::class,
            function () use ($data): void {
                $data->get("key3");
            }
        );
    }



    public function testHas(UnitTester $I): void
    {
        $data = new Data(
            [
                "key1" => "value1",
                "key2" => null,
            ]
        );

        $I->assertTrue(
            $data->has("key1")
        );

        $I->assertTrue(
            $data->has("key2")
        );

        $I->assertFalse(
            $data->has("key3")
        );
    }



    public function testToArray(UnitTester $I): void
    {
        $array = [
            "key1" => "value1",
            "key2" => "value2",
        ];

        $data = new Data($array);

        $I->assertEquals(
            $array,
            $data->toArray()
        );
    }
}
