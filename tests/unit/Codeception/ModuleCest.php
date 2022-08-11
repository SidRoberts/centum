<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Codeception\Module;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Exception;
use Mockery;
use Tests\UnitTester;

class ModuleCest
{
    public function testBeforeSetsAndAfterRemovesTheConnector(UnitTester $I): void
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

    public function testExceptionIsThrownIfContainerFileIsntAContainer(UnitTester $I): void
    {
        $moduleContainer = Mockery::mock(ModuleContainer::class);

        $module = new Module(
            $moduleContainer,
            [
                "container" => ".php-cs-fixer.dist.php",
            ]
        );

        $test = Mockery::mock(TestInterface::class);

        $I->expectThrowable(
            \TypeError::class,
            function () use ($module, $test) {
                $module->_before($test);
            }
        );
    }

    public function testGetStdoutContent(UnitTester $I): void
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

    public function testGetStderrContent(UnitTester $I): void
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



    public function testAssertStdoutEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStdoutNotEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStdoutContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutContains("quick");
    }

    public function testAssertStdoutNotContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $I->assertStdoutNotContains("slow");
    }



    public function testAssertStderrEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStderrNotEquals(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStderrContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrContains("quick");
    }

    public function testAssertStderrNotContains(UnitTester $I): void
    {
        $terminal = $I->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $I->assertStderrNotContains("slow");
    }

    public function testExpectEcho(UnitTester $I): void
    {
        $I->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function () {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }

    public function testExpectEchoWithAnException(UnitTester $I): void
    {
        $I->expectThrowable(
            new Exception("this is an exception"),
            function () use ($I) {
                $I->expectEcho(
                    "The quick brown fox jumps over the lazy dog.",
                    function () {
                        echo "this should be cleared.";

                        throw new Exception("this is an exception");
                    }
                );
            }
        );

        $I->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function () {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }
}
