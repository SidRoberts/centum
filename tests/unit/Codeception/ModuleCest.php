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

        $terminal = $I->createTerminal(
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

        $terminal = $I->createTerminal(
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



    public function assertStdoutEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function assertStdoutNotEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function assertStdoutContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutContains("quick");
    }

    public function assertStdoutNotContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutNotContains("slow");
    }



    public function assertStderrEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function assertStderrNotEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function assertStderrContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrContains("quick");
    }

    public function assertStderrNotContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrNotContains("slow");
    }
}
