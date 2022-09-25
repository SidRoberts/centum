<?php

namespace Tests\Unit\Container;

use Centum\Container\Container;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ContainerInterface;
use stdClass;
use Tests\Support\Container\Alias\ACommand;
use Tests\Support\Container\Alias\CommandInterface;
use Tests\Support\Container\DifferentTypes;
use Tests\Support\Container\Incrementer;
use Tests\Support\Container\ResolvableClass;
use Tests\Support\Container\ResolvableClassNoConstructor;
use Tests\Support\Container\UnresolvableClass;
use Tests\Support\UnitTester;

class ContainerCest
{
    public function testGetContainer(UnitTester $I): void
    {
        $container = new Container();

        $I->assertSame(
            $container,
            $container->typehintClass(Container::class)
        );
    }

    public function testGetContainerInterface(UnitTester $I): void
    {
        $container = new Container();

        $I->assertSame(
            $container,
            $container->typehintClass(ContainerInterface::class)
        );
    }

    public function testTypehintClass(UnitTester $I): void
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



    public function testTypehintFunction(UnitTester $I): void
    {
        $container = new Container();

        /** @var Incrementer */
        $incrementer = $container->typehintFunction(
            function (Incrementer $incrementer) {
                return $incrementer;
            }
        );

        $I->assertInstanceOf(
            Incrementer::class,
            $incrementer
        );
    }



    public function testSetDynamic(UnitTester $I): void
    {
        $container = new Container();

        $container->setDynamic(
            Incrementer::class,
            function (): Incrementer {
                $incrementer = new Incrementer();

                $incrementer->increment();
                $incrementer->increment();

                return $incrementer;
            }
        );

        $incrementer = $container->typehintClass(Incrementer::class);

        $I->assertInstanceOf(
            Incrementer::class,
            $incrementer
        );

        $I->assertEquals(
            2,
            $incrementer->getI()
        );
    }



    public function testIncrementer(UnitTester $I): void
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

    public function testResolvableClass(UnitTester $I): void
    {
        $container = new Container();

        $resolvableClass = $container->typehintClass(ResolvableClass::class);

        $incrementer = $container->typehintClass(Incrementer::class);

        $I->assertSame(
            $incrementer,
            $resolvableClass->getIncrementer()
        );
    }

    public function testResolvableClassNoConstructor(UnitTester $I): void
    {
        $container = new Container();

        $resolvableClassNoConstructor = $container->typehintClass(ResolvableClassNoConstructor::class);

        $I->assertInstanceOf(
            ResolvableClassNoConstructor::class,
            $resolvableClassNoConstructor
        );
    }

    public function testUnresolvableClass(UnitTester $I): void
    {
        $container = new Container();

        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container): void {
                $container->typehintClass(UnresolvableClass::class);
            }
        );
    }

    public function testResolveDifferentTypes(UnitTester $I): void
    {
        $container = new Container();

        $differentTypes = new DifferentTypes();



        /** @var string */
        $name = $container->typehintMethod($differentTypes, "resolvable");

        $I->assertEquals(
            "Sid",
            $name
        );



        /** @var ?string */
        $name = $container->typehintMethod($differentTypes, "resolvable2");

        $I->assertNull(
            $name
        );



        /** @var ?string */
        $name = $container->typehintMethod($differentTypes, "resolvable3");

        $I->assertNull(
            $name
        );



        /** @var mixed */
        $name = $container->typehintMethod($differentTypes, "resolvable4");

        $I->assertEquals(
            "Sid",
            $name
        );



        /** @var mixed */
        $name = $container->typehintMethod($differentTypes, "resolvable5");

        $I->assertNull(
            $name
        );



        /** @var mixed */
        $name = $container->typehintMethod($differentTypes, "resolvable6");

        $I->assertEquals(
            "Sid",
            $name
        );



        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container, $differentTypes): void {
                $container->typehintMethod($differentTypes, "unresolvable");
            }
        );



        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container, $differentTypes): void {
                $container->typehintMethod($differentTypes, "unresolvable2");
            }
        );
    }

    public function testAliases(UnitTester $I): void
    {
        $container = new Container();

        $container->addAlias(CommandInterface::class, ACommand::class);

        $object = $container->typehintClass(CommandInterface::class);

        $I->assertInstanceOf(
            ACommand::class,
            $object
        );
    }

    public function testRemove(UnitTester $I): void
    {
        $container = new Container();

        $incrementer1 = $container->typehintClass(Incrementer::class);

        $container->remove(Incrementer::class);

        $incrementer2 = $container->typehintClass(Incrementer::class);

        $I->assertNotSame($incrementer1, $incrementer2);
    }
}
