<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Codeception\Module;
use Centum\Console\Application;
use Centum\Container\Container;
use Centum\Interfaces\Console\ApplicationInterface;
use Codeception\Lib\Di;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Exception;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Commands\ExitCodeCommand;
use Tests\Support\Commands\FilterCommand;
use Tests\Support\Container\Incrementer;
use Tests\Support\UnitTester;
use TypeError;

class ModuleCest
{
    public function getModule(string $containerFile = "tests/Support/Data/container.php"): Module
    {
        $di = new Di();

        $moduleContainer = new ModuleContainer($di, []);

        return new Module(
            $moduleContainer,
            [
                "container" => $containerFile,
            ]
        );
    }



    public function testMakeNewContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->makeNewContainer();

        $container1 = $module->getContainer();

        $module->makeNewContainer();

        $container2 = $module->getContainer();

        $I->assertNotSame(
            $container1,
            $container2
        );
    }

    public function testMakeNewContainerNotRealFile(UnitTester $I): void
    {
        $module = $this->getModule("/not/a/real/file");

        $I->expectThrowable(
            Exception::class,
            function () use ($module): void {
                $module->makeNewContainer();
            }
        );
    }

    public function testMakeNewContainerFileDoesntReturnContainerInstance(UnitTester $I): void
    {
        $module = $this->getModule("codeception.yml");

        $I->expectThrowable(
            TypeError::class,
            function () use ($module): void {
                $module->makeNewContainer();
            }
        );
    }



    public function testGetContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $container = $module->getContainer();

        $I->assertInstanceOf(
            Container::class,
            $container
        );
    }

    public function testGetContainerBeforeSettingIt(UnitTester $I): void
    {
        $module = $this->getModule();

        $I->expectThrowable(
            ContainerNotFoundException::class,
            function () use ($module): void {
                $module->getContainer();
            }
        );
    }



    public function testAddToContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $incrementer = new Incrementer();

        $module->addToContainer(Incrementer::class, $incrementer);

        $container = $module->getContainer();

        $I->assertSame(
            $incrementer,
            $container->get(Incrementer::class)
        );
    }



    public function testBeforeSetsAndAfterRemovesTheConnector(UnitTester $I): void
    {
        $module = $this->getModule();

        $test = $I->mock(TestInterface::class);

        $module->_beforeSuite();

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

        $module->_afterSuite();
    }

    public function testExceptionIsThrownIfContainerFileIsntAContainer(UnitTester $I): void
    {
        $module = $this->getModule(".php-cs-fixer.dist.php");

        $test = $I->mock(TestInterface::class);

        $I->expectThrowable(
            TypeError::class,
            function () use ($module, $test): void {
                $module->_before($test);
            }
        );
    }

    public function testGetStdoutContent(UnitTester $I): void
    {
        $module = $this->getModule();

        $I->assertEquals(
            "",
            $module->getStdoutContent()
        );

        $terminal = $module->createTerminal(
            []
        );

        $terminal->write("Hello.");

        $I->assertEquals(
            "Hello.",
            $module->getStdoutContent()
        );

        $terminal->write("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $module->getStdoutContent()
        );
    }

    public function testGetStderrContent(UnitTester $I): void
    {
        $module = $this->getModule();

        $I->assertEquals(
            "",
            $module->getStderrContent()
        );

        $terminal = $module->createTerminal(
            []
        );

        $terminal->writeError("Hello.");

        $I->assertEquals(
            "Hello.",
            $module->getStderrContent()
        );

        $terminal->writeError("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $module->getStderrContent()
        );
    }



    public function testGetConsoleApplication(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $container = $module->getContainer();

        $application = new Application($container);

        $module->addToContainer(ApplicationInterface::class, $application);

        $I->assertSame(
            $application,
            $module->getConsoleApplication()
        );
    }



    public function testAddCommand(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $command = new BoringCommand();

        $module->addCommand($command);

        $application = $module->getConsoleApplication();

        $I->assertSame(
            $command,
            $application->getCommand("boring")
        );
    }



    public function testRunCommand(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $command = new FilterCommand();

        $module->addCommand($command);

        $exitCode = $module->runCommand(
            [
                "cli.php",
                "filter:double",
                "--i",
                "123"
            ]
        );

        $I->assertEquals(
            0,
            $exitCode
        );

        $I->assertSame(
            "246",
            $module->getStdoutContent()
        );
    }



    public function testAssertExitCodeIs(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $command = new ExitCodeCommand(0);

        $module->addCommand($command);

        $module->runCommand(
            [
                "cli.php",
                "exit-code",
            ]
        );

        $module->assertExitCodeIs(0);
    }

    public function testAssertExitCodeIsNot(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $command = new ExitCodeCommand(1);

        $module->addCommand($command);

        $module->runCommand(
            [
                "cli.php",
                "exit-code",
            ]
        );

        $module->assertExitCodeIsNot(0);
    }



    public function testAssertStdoutEquals(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $module->assertStdoutEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStdoutNotEquals(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $module->assertStdoutNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStdoutContains(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $module->assertStdoutContains("quick");
    }

    public function testAssertStdoutNotContains(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $module->assertStdoutNotContains("slow");
    }



    public function testAssertStderrEquals(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $module->assertStderrEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStderrNotEquals(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $module->assertStderrNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStderrContains(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $module->assertStderrContains("quick");
    }

    public function testAssertStderrNotContains(UnitTester $I): void
    {
        $module = $this->getModule();

        $terminal = $module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $module->assertStderrNotContains("slow");
    }

    public function testExpectEcho(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function (): void {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }

    public function testExpectEchoWithAnException(UnitTester $I): void
    {
        $module = $this->getModule();

        $I->expectThrowable(
            new Exception("this is an exception"),
            function () use ($module): void {
                $module->expectEcho(
                    "The quick brown fox jumps over the lazy dog.",
                    function (): void {
                        echo "this should be cleared.";

                        throw new Exception("this is an exception");
                    }
                );
            }
        );

        $module->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function (): void {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }
}
