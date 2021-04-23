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

    public function getStdoutContent(UnitTester $I)
    {
        $I->assertEquals(
            "",
            $I->getStdoutContent()
        );

        $terminal = $I->getTerminal(
            []
        );

        $terminal->write("Hello.");

        $I->assertEquals(
            "Hello.",
            $I->getStdoutContent()
        );

        $terminal->write("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $I->getStdoutContent()
        );
    }

    public function getStderrContent(UnitTester $I)
    {
        $I->assertEquals(
            "",
            $I->getStderrContent()
        );

        $terminal = $I->getTerminal(
            []
        );

        $terminal->writeError("Hello.");

        $I->assertEquals(
            "Hello.",
            $I->getStderrContent()
        );

        $terminal->writeError("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $I->getStderrContent()
        );
    }
}
