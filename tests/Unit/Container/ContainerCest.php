<?php

namespace Tests\Unit\Container;

use Centum\Container\AliasManager;
use Centum\Container\Container;
use Centum\Container\Exception\InstantiateInterfaceException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Container\ObjectStorage;
use Centum\Container\ResolverGroup;
use Centum\Interfaces\Container\AliasManagerInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Container\ResolverGroupInterface;
use stdClass;
use Tests\Support\Container\DifferentTypes;
use Tests\Support\Container\Incrementer;
use Tests\Support\Container\ResolvableClass;
use Tests\Support\Container\ResolvableClassNoConstructor;
use Tests\Support\Container\Services\IncrementerService;
use Tests\Support\Container\UnresolvableClass;
use Tests\Support\UnitTester;
use Throwable;

/**
 * @covers \Centum\Container\Container
 */
final class ContainerCest
{
    public function testGetAliasManagerDefault(UnitTester $I): void
    {
        $container = new Container();

        $I->assertInstanceOf(
            AliasManagerInterface::class,
            $container->getAliasManager()
        );
    }

    public function testGetAliasManagerCustom(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $container = new Container($aliasManager);

        $I->assertSame(
            $aliasManager,
            $container->getAliasManager()
        );
    }



    public function testGetResolverGroupDefault(UnitTester $I): void
    {
        $container = new Container();

        $I->assertInstanceOf(
            ResolverGroupInterface::class,
            $container->getResolverGroup()
        );
    }

    public function testGetResolverGroupCustom(UnitTester $I): void
    {
        $resolverGroup = new ResolverGroup();

        $container = new Container(null, $resolverGroup);

        $I->assertSame(
            $resolverGroup,
            $container->getResolverGroup()
        );
    }



    public function testGetObjectStorageDefault(UnitTester $I): void
    {
        $container = new Container();

        $I->assertInstanceOf(
            ObjectStorageInterface::class,
            $container->getObjectStorage()
        );
    }

    public function testGetObjectStorageCustom(UnitTester $I): void
    {
        $objectStorage = new ObjectStorage();

        $container = new Container(null, null, $objectStorage);

        $I->assertSame(
            $objectStorage,
            $container->getObjectStorage()
        );
    }



    public function testGetContainerInterface(UnitTester $I): void
    {
        $container = new Container();

        $I->assertSame(
            $container,
            $container->get(ContainerInterface::class)
        );
    }

    public function testGet(UnitTester $I): void
    {
        $container = new Container();

        $a = $container->get(stdClass::class);

        $I->assertInstanceOf(
            stdClass::class,
            $a
        );

        $a->name = "Sid";

        $b = $container->get(stdClass::class);

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

        $serviceStorage = $container->getServiceStorage();

        $serviceStorage->set(Incrementer::class, IncrementerService::class);

        $incrementer = $container->get(Incrementer::class);

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

        $incrementer0 = $container->get(Incrementer::class);

        $incrementer0->increment();

        $incrementer1 = $container->get(Incrementer::class);

        $incrementer1->increment();

        $incrementer2 = $container->get(Incrementer::class);

        $I->assertEquals(
            2,
            $incrementer2->getI()
        );

        $I->assertSame($incrementer0, $incrementer2);
    }

    public function testResolvableClass(UnitTester $I): void
    {
        $container = new Container();

        $resolvableClass = $container->get(ResolvableClass::class);

        $incrementer = $container->get(Incrementer::class);

        $I->assertSame(
            $incrementer,
            $resolvableClass->getIncrementer()
        );
    }

    public function testResolvableClassNoConstructor(UnitTester $I): void
    {
        $container = new Container();

        $resolvableClassNoConstructor = $container->get(ResolvableClassNoConstructor::class);

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
                $container->get(UnresolvableClass::class);
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
    }



    public function testInstantiateInterfaceException(UnitTester $I): void
    {
        $container = new Container();

        $interface = Throwable::class;

        $I->expectThrowable(
            new InstantiateInterfaceException($interface),
            function () use ($container, $interface): void {
                $container->get($interface);
            }
        );
    }
}
