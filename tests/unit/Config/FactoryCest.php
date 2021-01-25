<?php

namespace Centum\Tests\Config;

use Centum\Config\Config;
use Centum\Config\Factory;
use Centum\Tests\UnitTester;

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
            "Centum\\Tests",
            $config->namespace
        );
    }
}
