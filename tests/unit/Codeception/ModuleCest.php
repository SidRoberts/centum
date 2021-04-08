<?php

namespace Tests\Codeception;

use Centum\Codeception\Connector;
use Centum\Codeception\Module;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Mockery;
use Tests\UnitTester;

class ModuleCest
{
    public function beforeSetsAndAfterRemovesTheConnector(UnitTester $I): void
    {
        $moduleContainer = Mockery::mock(ModuleContainer::class);

        $module = new Module(
            $moduleContainer,
            [
                "container" => "tests/_data/container.php",
            ]
        );

        $test = Mockery::mock(TestInterface::class);

        $I->assertNull(
            $module->client
        );

        $module->_before($test);

        $I->assertInstanceOf(
            Connector::class,
            $module->client
        );

        $module->_after($test);

        $I->assertNull(
            $module->client
        );
    }
}
