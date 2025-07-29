<?php

namespace Tests\Codeception;

use Centum\Router\Router;
use stdClass;
use Tests\Support\CodeceptionTester;
use Tests\Support\Container\Incrementer;

/**
 * @covers \Centum\Codeception\Actions\ContainerActions
 */
final class ContainerActionsCest
{
    public function testAddToContainer(CodeceptionTester $I): void
    {
        $incrementer = new Incrementer();

        $I->addToContainer(Incrementer::class, $incrementer);

        $container = $I->grabContainer();

        $I->assertSame(
            $incrementer,
            $container->get(Incrementer::class)
        );
    }

    public function testGrabFromContainer(CodeceptionTester $I): void
    {
        $incrementer = new Incrementer();

        $I->addToContainer(Incrementer::class, $incrementer);

        $I->assertSame(
            $incrementer,
            $I->grabFromContainer(Incrementer::class)
        );
    }

    public function testRemoveFromContainer(CodeceptionTester $I): void
    {
        $router1 = $I->grabFromContainer(Router::class);

        $I->removeFromContainer(Router::class);

        $router2 = $I->grabFromContainer(Router::class);

        $I->assertNotSame(
            $router1,
            $router2
        );
    }

    public function testMockInContainer(CodeceptionTester $I): void
    {
        $I->mockInContainer(stdClass::class);

        $object = $I->grabFromContainer(stdClass::class);

        $I->assertInstanceOf(
            stdClass::class,
            $object
        );

        $I->assertInstanceOf(
            stdClass::class,
            $object
        );
    }
}
