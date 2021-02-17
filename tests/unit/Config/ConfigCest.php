<?php

namespace Tests\Config;

use Centum\Config\Config;
use Tests\UnitTester;

class ConfigCest
{
    public function testGet(UnitTester $I)
    {
        $config = new Config(
            [
                "a" => 1,
                "b" => [
                    "c" => 2,
                ],
            ]
        );

        $I->assertEquals(
            1,
            $config->a
        );

        $I->assertEquals(
            2,
            $config->b->c
        );
    }

    public function testToArray(UnitTester $I)
    {
        $data = [
            "a" => 1,
            "b" => [
                "c" => 2,
            ],
        ];

        $config = new Config($data);

        $I->assertEquals(
            $data,
            $config->toArray()
        );
    }

    public function testSet(UnitTester $I)
    {
        $config = new Config(
            []
        );

        $config->a = 123;

        $I->assertEquals(
            123,
            $config->a
        );

        $config->b = [
            "x" => 1,
            "y" => 2,
            "z" => 3,
        ];

        $I->assertInstanceOf(
            Config::class,
            $config->b
        );

        $I->assertEquals(
            1,
            $config->b->x
        );
    }

    public function testIsset(UnitTester $I)
    {
        $data = [
            "a" => 1,
            "b" => [
                "c" => 2,
            ],
        ];

        $config = new Config($data);

        $I->assertTrue(
            isset($config->a)
        );

        $I->assertTrue(
            isset($config->b->c)
        );

        $I->assertFalse(
            isset($config->c)
        );
    }

    public function testUnset(UnitTester $I)
    {
        $data = [
            "a" => 1,
            "b" => [
                "c" => 2,
            ],
        ];

        $config = new Config($data);

        $I->assertTrue(
            isset($config->b->c)
        );

        unset($config->b->c);

        $I->assertTrue(
            isset($config->b)
        );

        $I->assertFalse(
            isset($config->b->c)
        );
    }
}
