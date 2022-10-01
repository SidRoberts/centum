<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Codeception\Module;
use Centum\Container\Container;
use Codeception\Lib\Di;
use Codeception\Lib\ModuleContainer;
use Codeception\TestInterface;
use Exception;
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

        $container1 = $module->grabContainer();

        $module->makeNewContainer();

        $container2 = $module->grabContainer();

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



    public function testGrabContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $container = $module->grabContainer();

        $I->assertInstanceOf(
            Container::class,
            $container
        );
    }

    public function testGrabContainerBeforeSettingIt(UnitTester $I): void
    {
        $module = $this->getModule();

        $I->expectThrowable(
            ContainerNotFoundException::class,
            function () use ($module): void {
                $module->grabContainer();
            }
        );
    }



    public function testAddToContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $incrementer = new Incrementer();

        $module->addToContainer(Incrementer::class, $incrementer);

        $container = $module->grabContainer();

        $I->assertSame(
            $incrementer,
            $container->get(Incrementer::class)
        );
    }

    public function testGrabFromContainer(UnitTester $I): void
    {
        $module = $this->getModule();

        $module->_beforeSuite();

        $incrementer = new Incrementer();

        $module->addToContainer(Incrementer::class, $incrementer);

        $I->assertSame(
            $incrementer,
            $module->grabFromContainer(Incrementer::class)
        );
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
}
