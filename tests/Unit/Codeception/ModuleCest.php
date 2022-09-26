<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Codeception\Module;
use Centum\Console\Application;
use Centum\Container\Container;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Exception;
use Mockery;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Commands\FilterCommand;
use Tests\Support\Container\Incrementer;
use Tests\Support\UnitTester;
use TypeError;

class ModuleCest
{
    protected ModuleContainer $moduleContainer;



    public function _before(UnitTester $I): void
    {
        $this->moduleContainer = Mockery::mock(ModuleContainer::class);
    }



    public function testMakeNewContainer(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

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
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

        $module->_beforeSuite();

        $container = $module->getContainer();

        $I->assertInstanceOf(
            Container::class,
            $container
        );
    }

    public function testGetContainerBeforeSettingIt(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

        $I->expectThrowable(
            ContainerNotFoundException::class,
            function () use ($module): void {
                $module->getContainer();
            }
        );
    }



    public function testAddToContainer(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

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
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

        $test = Mockery::mock(TestInterface::class);

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



    public function testGetConsoleApplication(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

        $module->_beforeSuite();

        $container = $module->getContainer();

        $application = new Application($container);

        $module->addToContainer(Application::class, $application);

        $I->assertSame(
            $application,
            $module->getConsoleApplication()
        );
    }



    public function testAddCommand(UnitTester $I): void
    {
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

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
        $module = new Module(
            $this->moduleContainer,
            [
                "container" => "tests/Support/Data/container.php",
            ]
        );

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
            function (): void {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }

    public function testExpectEchoWithAnException(UnitTester $I): void
    {
        $I->expectThrowable(
            new Exception("this is an exception"),
            function () use ($I): void {
                $I->expectEcho(
                    "The quick brown fox jumps over the lazy dog.",
                    function (): void {
                        echo "this should be cleared.";

                        throw new Exception("this is an exception");
                    }
                );
            }
        );

        $I->expectEcho(
            "The quick brown fox jumps over the lazy dog.",
            function (): void {
                echo "The quick brown fox jumps over the lazy dog.";
            }
        );
    }
}
