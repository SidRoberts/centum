<?php

namespace Centum\Tests\Mvc;

use Centum\Container\Resolver;
use Centum\Mvc\Dispatcher;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Parameters;
use Centum\Container\Container;
use Centum\Tests\Mvc\Controller\IndexController;
use Centum\Tests\Mvc\Controller\MathController;
use Centum\Tests\UnitTester;

class DispatcherCest
{
    public function simpleDispatch(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $dispatcher = new Dispatcher($resolver);



        $returnedValue = $dispatcher->dispatch(
            new Path(
                IndexController::class,
                "index"
            ),
            new Parameters(
                []
            )
        );

        $I->assertEquals(
            "homepage",
            $returnedValue
        );
    }

    public function params(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $dispatcher = new Dispatcher($resolver);



        $returnedValue = $dispatcher->dispatch(
            new Path(
                MathController::class,
                "addition"
            ),
            new Parameters(
                [
                    "a" => 2,
                    "b" => "3",
                ]
            )
        );

        $I->assertEquals(
            5,
            $returnedValue
        );
    }
}
