<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Codeception\Module;
use Centum\Console\Application;
use Centum\Container\Container;
use Centum\Interfaces\Console\ApplicationInterface;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Exception;
use Mockery;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Commands\ExitCodeCommand;
use Tests\Support\Commands\FilterCommand;
use Tests\Support\Container\Incrementer;
use Tests\Support\UnitTester;
use TypeError;

class ModuleCest
{
    protected ModuleContainer $moduleContainer;
    protected Module $module;



    public function _before(UnitTester $I): void
    {
        $this->moduleContainer = Mockery::mock(ModuleContainer::class);

        $this->module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );
    }



    public function testMakeNewContainer(UnitTester $I): void
    {
        $this->module->makeNewContainer();

        $container1 = $this->module->getContainer();

        $this->module->makeNewContainer();

        $container2 = $this->module->getContainer();

        $I->assertNotSame(
            $container1,
            $container2
        );
    }

    public function testMakeNewContainerNotRealFile(UnitTester $I): void
    {
        $fakeFile = "/not/a/real/file";

        $module = new Module(
            $this->moduleContainer,
            [
                "container" => $fakeFile,
            ]
        );

        $I->expectThrowable(
            Exception::class,
            function () use ($module): void {
                $module->makeNewContainer();
            }
        );
    }

    public function testMakeNewContainerFileDoesntReturnContainerInstance(UnitTester $I): void
    {
        $fakeFile = "codeception.yml";

        $module = new Module(
            $this->moduleContainer,
            [
                "container" => $fakeFile,
            ]
        );

        $I->expectThrowable(
            TypeError::class,
            function () use ($module): void {
                $module->makeNewContainer();
            }
        );
    }



    public function testGetContainer(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $container = $this->module->getContainer();

        $I->assertInstanceOf(
            Container::class,
            $container
        );
    }

    public function testGetContainerBeforeSettingIt(UnitTester $I): void
    {
        $module = $this->module;

        $I->expectThrowable(
            ContainerNotFoundException::class,
            function () use ($module): void {
                $module->getContainer();
            }
        );
    }



    public function testAddToContainer(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $incrementer = new Incrementer();

        $this->module->addToContainer(Incrementer::class, $incrementer);

        $container = $this->module->getContainer();

        $I->assertSame(
            $incrementer,
            $container->get(Incrementer::class)
        );
    }



    public function testBeforeSetsAndAfterRemovesTheConnector(UnitTester $I): void
    {
        $test = Mockery::mock(TestInterface::class);

        $this->module->_beforeSuite();

        $I->assertNull(
            $this->module->client
        );

        $this->module->_before($test);

        $I->assertInstanceOf(
            Connector::class,
            $this->module->client
        );

        $this->module->_after($test);

        $I->assertNull(
            $this->module->client
        );

        $this->module->_afterSuite();
    }

    public function testExceptionIsThrownIfContainerFileIsntAContainer(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => ".php-cs-fixer.dist.php",
            ]
        );

        $test = Mockery::mock(TestInterface::class);

        $I->expectThrowable(
            \TypeError::class,
            function () use ($module, $test): void {
                $module->_before($test);
            }
        );
    }

    public function testGetStdoutContent(UnitTester $I): void
    {
        $I->assertEquals(
            "",
            $this->module->getStdoutContent()
        );

        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->write("Hello.");

        $I->assertEquals(
            "Hello.",
            $this->module->getStdoutContent()
        );

        $terminal->write("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $this->module->getStdoutContent()
        );
    }

    public function testGetStderrContent(UnitTester $I): void
    {
        $I->assertEquals(
            "",
            $this->module->getStderrContent()
        );

        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->writeError("Hello.");

        $I->assertEquals(
            "Hello.",
            $this->module->getStderrContent()
        );

        $terminal->writeError("Goodbye.");

        $I->assertEquals(
            "Hello.Goodbye.",
            $this->module->getStderrContent()
        );
    }



    public function testGetConsoleApplication(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $container = $this->module->getContainer();

        $application = new Application($container);

        $this->module->addToContainer(ApplicationInterface::class, $application);

        $I->assertSame(
            $application,
            $this->module->getConsoleApplication()
        );
    }



    public function testAddCommand(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $command = new BoringCommand();

        $this->module->addCommand($command);

        $application = $this->module->getConsoleApplication();

        $I->assertSame(
            $command,
            $application->getCommand("boring")
        );
    }



    public function testRunCommand(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $command = new FilterCommand();

        $this->module->addCommand($command);

        $exitCode = $this->module->runCommand(
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
            $this->module->getStdoutContent()
        );
    }



    public function testAssertExitCodeIs(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $command = new ExitCodeCommand(0);

        $this->module->addCommand($command);

        $this->module->runCommand(
            [
                "cli.php",
                "exit-code",
            ]
        );

        $this->module->assertExitCodeIs(0);
    }

    public function testAssertExitCodeIsNot(UnitTester $I): void
    {
        $this->module->_beforeSuite();

        $command = new ExitCodeCommand(1);

        $this->module->addCommand($command);

        $this->module->runCommand(
            [
                "cli.php",
                "exit-code",
            ]
        );

        $this->module->assertExitCodeIsNot(0);
    }



    public function testAssertStdoutEquals(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStdoutEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStdoutNotEquals(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStdoutNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStdoutContains(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStdoutContains("quick");
    }

    public function testAssertStdoutNotContains(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->write("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStdoutNotContains("slow");
    }



    public function testAssertStderrEquals(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStderrEquals("The quick brown fox jumps over the lazy dog.");
    }

    public function testAssertStderrNotEquals(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStderrNotEquals("The slow brown fox jumps over the energetic dog.");
    }

    public function testAssertStderrContains(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStderrContains("quick");
    }

    public function testAssertStderrNotContains(UnitTester $I): void
    {
        $terminal = $this->module->createTerminal(
            []
        );

        $terminal->writeError("The quick brown fox jumps over the lazy dog.");

        $this->module->assertStderrNotContains("slow");
    }

    public function testExpectEcho(UnitTester $I): void
    {
        $this->module->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function (): void {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }

    public function testExpectEchoWithAnException(UnitTester $I): void
    {
        $module = $this->module;

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
