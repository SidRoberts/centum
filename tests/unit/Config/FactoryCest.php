<?php

namespace Tests\Config;

use Centum\Config\Config;
use Centum\Config\Factory;
use Tests\UnitTester;

class FactoryCest
{
    public function test(UnitTester $I)
    {
        $config = Factory::yaml(
            codecept_root_dir() . "/codeception.yml"
        );

        $I->assertInstanceOf(
            Config::class,
            $config
        );

        $I->assertEquals(
            "Tests",
            $config->namespace
        );
    }
}
