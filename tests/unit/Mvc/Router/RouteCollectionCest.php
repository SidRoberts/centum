<?php

namespace Centum\Tests\Mvc\Router;

use Centum\Mvc\Router;
use Centum\Mvc\Router\Exception\ControllerNotFoundException;
use Centum\Mvc\Router\Exception\NotAControllerException;
use Centum\Mvc\Router\Exception\NotAnActionMethodException;
use Centum\Mvc\Router\RouteCollection;
use Centum\Tests\Mvc\Controller\BadActionMethodController;
use Centum\Tests\Mvc\Controller\IndexController;
use Centum\Tests\Mvc\Controller\ParametersController;
use Centum\Tests\UnitTester;

class RouteCollectionCest
{
    public function addController(UnitTester $I)
    {
        $routeCollection = new RouteCollection();

        $I->assertCount(
            0,
            $routeCollection->getRoutes()
        );

        $routeCollection->addController(
            IndexController::class
        );

        $I->assertCount(
            1,
            $routeCollection->getRoutes()
        );

        $routeCollection->addController(
            ParametersController::class
        );

        $I->assertCount(
            4,
            $routeCollection->getRoutes()
        );
    }

    public function addControllers(UnitTester $I)
    {
        $routeCollection = new RouteCollection();

        $I->assertCount(
            0,
            $routeCollection->getRoutes()
        );

        $routeCollection->addControllers(
            [
                IndexController::class,
                ParametersController::class,
            ]
        );

        $I->assertCount(
            4,
            $routeCollection->getRoutes()
        );
    }

    public function controllerNotFoundException(UnitTester $I)
    {
        $routeCollection = new RouteCollection();



        $I->expectThrowable(
            ControllerNotFoundException::class,
            function () use ($routeCollection) {
                $routeCollection->addController(
                    "A\\Class\\That\\Does\\Not\\Exist"
                );
            }
        );
    }

    public function notAControllerException(UnitTester $I)
    {
        $routeCollection = new RouteCollection();



        $I->expectThrowable(
            NotAControllerException::class,
            function () use ($routeCollection) {
                $routeCollection->addController(
                    Router::class
                );
            }
        );
    }

    public function notAValidActionMethodException(UnitTester $I)
    {
        $routeCollection = new RouteCollection();



        $I->expectThrowable(
            NotAnActionMethodException::class,
            function () use ($routeCollection) {
                $routeCollection->addController(
                    BadActionMethodController::class
                );
            }
        );
    }
}
