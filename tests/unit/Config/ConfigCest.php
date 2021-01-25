<?php

namespace Centum\Tests\Config;

use Centum\Config\Config;
use Centum\Tests\UnitTester;

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
}
