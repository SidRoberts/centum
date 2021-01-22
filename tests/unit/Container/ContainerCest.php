<?php

namespace Centum\Tests\Container;

use Centum\Container\Container;
use Centum\Container\Exception\ServiceNotFoundException;
use Centum\Container\RawService;
use Centum\Container\Resolver;
use Centum\Tests\UnitTester;
use Centum\Tests\Container\Services\HelloService;
use Centum\Tests\Container\Services\IncrementerService;
use Centum\Tests\Container\Services\InheritsHelloService;
use Centum\Tests\Container\Services\ParameterService;
use Centum\Tests\Container\Services\TypeHintedResolverService;

class ContainerCest
{
    public function testBasic(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );



        $I->assertEquals(
            "hello",
            $container->get("hello")
        );
    }



    public function testServiceDoesntExist(UnitTester $I)
    {
        $container = new Container();

        $I->expectThrowable(
            ServiceNotFoundException::class,
            function () use ($container) {
                $container->get("serviceThatDoesntExist");
            }
        );
    }



    public function testInheritance(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );

        $container->add(
            new InheritsHelloService()
        );



        $I->assertEquals(
            "hello",
            $container->get("hello")
        );

        $I->assertEquals(
            "hello",
            $container->get("inheritsHello")
        );
    }



    public function testServiceWithAParameter(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new ParameterService("Sid")
        );



        $I->assertEquals(
            "Hello Sid",
            $container->get("parameter")
        );
    }



    public function testHas(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );



        $I->assertTrue(
            $container->has("hello")
        );

        $I->assertFalse(
            $container->has("doesntExist")
        );
    }



    public function testSingleton(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new IncrementerService(false)
        );



        $I->assertEquals(
            0,
            $container->get("incrementer")->getI()
        );

        $container->get("incrementer")->increment();

        $I->assertEquals(
            0,
            $container->get("incrementer")->getI()
        );
    }



    public function testShared(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new IncrementerService(true)
        );



        $I->assertEquals(
            0,
            $container->get("incrementer")->getI()
        );

        $container->get("incrementer")->increment();

        $I->assertEquals(
            1,
            $container->get("incrementer")->getI()
        );
    }



    public function testRawService(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new RawService(
                "example",
                true,
                function (Container $container) {
                    return "hello";
                }
            )
        );



        $I->assertTrue(
            $container->has("example")
        );

        $I->assertEquals(
            "hello",
            $container->get("example")
        );
    }



    public function testTypeHintedResolver(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new TypeHintedResolverService()
        );

        $container->add(
            new ParameterService("Sid")
        );



        $I->assertEquals(
            "The 'parameter' service says: Hello Sid",
            $container->get("typeHintedResolver")
        );
    }



    public function testGetResolver(UnitTester $I)
    {
        $container = new Container();

        $resolver = $container->getResolver();

        $I->assertInstanceOf(
            Resolver::class,
            $resolver
        );
    }
}
