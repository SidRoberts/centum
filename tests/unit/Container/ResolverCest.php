<?php

namespace Centum\Tests\Container;

use Centum\Container\Container;
use Centum\Container\Resolver;
use Centum\Tests\Container\Services\HelloService;
use Centum\Tests\Container\Services\IncrementerService;
use Centum\Tests\Container\Services\ParameterService;
use Centum\Tests\Container\ResolvableClass;
use Centum\Tests\Container\ResolvableClassNoConstructor;
use Centum\Tests\UnitTester;

class ResolverCest
{
    public function testTypehintClass(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );

        $container->add(
            new ParameterService("Sid")
        );

        $container->add(
            new IncrementerService(true)
        );



        $resolver = new Resolver($container);



        $typehintedClass = $resolver->typehintClass(
            ResolvableClass::class
        );



        $I->assertEquals(
            "hello",
            $typehintedClass->hello
        );

        $I->assertEquals(
            "Hello Sid",
            $typehintedClass->parameter
        );

        $I->assertEquals(
            0,
            $typehintedClass->incrementer->getI()
        );
    }

    public function testTypehintClassNoConstructor(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $typehintedClass = $resolver->typehintClass(
            ResolvableClassNoConstructor::class
        );



        $I->assertInstanceOf(
            ResolvableClassNoConstructor::class,
            $typehintedClass
        );
    }
}
