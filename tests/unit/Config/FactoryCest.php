<?php

namespace Tests\Config;

use Centum\Config\Config;
use Centum\Config\Factory;
use Tests\UnitTester;
use ValueError;

class FactoryCest
{
    public function test(UnitTester $I) : void
    {
        $config = Factory::yaml(
            codecept_data_dir() . "/config-factory/good.yml"
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

    public function invalidYaml(UnitTester $I) : void
    {
        $I->expectThrowable(
            ValueError::class,
            function () {
                $config = Factory::yaml(
                    codecept_data_dir() . "/config-factory/bad.yml"
                );
            }
        );
    }
}
