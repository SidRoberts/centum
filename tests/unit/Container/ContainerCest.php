<?php

namespace Centum\Tests\Container;

use Centum\Container\Container;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Tests\UnitTester;
use stdClass;

class ContainerCest
{
    public function testGetContainer(UnitTester $I)
    {
        $container = new Container();

        $I->assertSame(
            $container,
            $container->typehintClass(Container::class)
        );
    }

    public function testTypehintClass(UnitTester $I)
    {
        $container = new Container();

        $a = $container->typehintClass(stdClass::class);

        $I->assertInstanceOf(
            stdClass::class,
            $a
        );

        $a->name = "Sid";

        $b = $container->typehintClass(stdClass::class);

        $b->city = "Busan";

        $I->assertSame($a, $b);

        $I->assertEquals("Sid", $b->name);

        $I->assertEquals("Busan", $a->city);
    }

    public function testIncrementer(UnitTester $I)
    {
        $container = new Container();

        $incrementer0 = $container->typehintClass(Incrementer::class);

        $incrementer0->increment();

        $incrementer1 = $container->typehintClass(Incrementer::class);

        $incrementer1->increment();

        $incrementer2 = $container->typehintClass(Incrementer::class);

        $I->assertEquals(
            2,
            $incrementer2->getI()
        );

        $I->assertSame($incrementer0, $incrementer2);
    }

    public function testResolvableClass(UnitTester $I)
    {
        $container = new Container();

        $resolvableClass = $container->typehintClass(ResolvableClass::class);

        $incrementer = $container->typehintClass(Incrementer::class);

        $I->assertSame(
            $incrementer,
            $resolvableClass->incrementer
        );
    }

    public function testResolvableClassNoConstructor(UnitTester $I)
    {
        $container = new Container();

        $resolvableClassNoConstructor = $container->typehintClass(ResolvableClassNoConstructor::class);

        $I->assertInstanceOf(
            ResolvableClassNoConstructor::class,
            $resolvableClassNoConstructor
        );
    }

    public function testUnresolvableClass(UnitTester $I)
    {
        $container = new Container();

        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container) {
                $unresolvableClass = $container->typehintClass(UnresolvableClass::class);
            }
        );
    }
}
