<?php

namespace Tests\Http;

use Centum\Http\Data;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Data
 */
class DataCest
{
    public function testGet(UnitTester $I): void
    {
        $data = new Data(
            [
                "key1" => "value1",
                "key2" => "value2",
            ]
        );

        $I->assertEquals(
            "value1",
            $data->get("key1")
        );

        $I->assertEquals(
            "value2",
            $data->get("key2")
        );

        $I->assertNull(
            $data->get("key3")
        );

        $I->assertEquals(
            "value1",
            $data->get("key1", "default value")
        );

        $I->assertEquals(
            "value2",
            $data->get("key2", "default value")
        );

        $I->assertEquals(
            "default value",
            $data->get("key3", "default value")
        );
    }



    public function testHas(UnitTester $I): void
    {
        $data = new Data(
            [
                "key1" => "value1",
                "key2" => "value2",
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
