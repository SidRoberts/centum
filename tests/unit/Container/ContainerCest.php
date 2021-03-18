<?php

namespace Tests\Container;

use Centum\Config\Config;
use Centum\Url\Url;
use Centum\Container\Container;
use Centum\Container\Exception\UnresolvableParameterException;
use Tests\Container\Alias\ACommand;
use Tests\Container\Alias\CommandInterface;
use Tests\UnitTester;
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

    public function testSetDynamic(UnitTester $I)
    {
        $container = new Container();

        $config = new Config(
            [
                "url" => [
                    "baseUri" => "/api/",
                ],
            ]
        );

        $container->set(Config::class, $config);

        $container->setDynamic(
            Url::class,
            function (Config $config) {
                $url = new Url(
                    $config->url->baseUri
                );

                return $url;
            }
        );

        $url = $container->typehintClass(Url::class);

        $I->assertEquals(
            "/api/",
            $url->getBaseUri()
        );
    }

    public function resolveDifferentTypes(UnitTester $I)
    {
        $container = new Container();

        $differentTypes = new DifferentTypes();



        $name = $container->typehintMethod($differentTypes, "resolvable");

        $I->assertEquals(
            "Sid",
            $name
        );



        $name = $container->typehintMethod($differentTypes, "resolvable2");

        $I->assertNull(
            $name
        );



        $name = $container->typehintMethod($differentTypes, "resolvable3");

        $I->assertNull(
            $name
        );



        $name = $container->typehintMethod($differentTypes, "resolvable4");

        $I->assertEquals(
            "Sid",
            $name
        );



        $name = $container->typehintMethod($differentTypes, "resolvable5");

        $I->assertNull(
            $name
        );



        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container, $differentTypes) {
                $container->typehintMethod($differentTypes, "unresolvable");
            }
        );



        $I->expectThrowable(
            UnresolvableParameterException::class,
            function () use ($container, $differentTypes) {
                $container->typehintMethod($differentTypes, "unresolvable2");
            }
        );
    }

    public function aliases(UnitTester $I)
    {
        $container = new Container();

        $container->addAlias(CommandInterface::class, ACommand::class);

        $object = $container->typehintClass(CommandInterface::class);

        $I->assertInstanceOf(
            ACommand::class,
            $object
        );
    }
}
