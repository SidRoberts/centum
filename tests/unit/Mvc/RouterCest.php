<?php

namespace Centum\Tests\Mvc;

use Centum\Container\Container;
use Centum\Container\Resolver;
use Centum\Mvc\Router;
use Centum\Mvc\Router\Exception\RouteNotFoundException;
use Centum\Mvc\Router\Route;
use Centum\Mvc\Router\RouteCollection;
use Centum\Tests\Mvc\Controller\ConverterController;
use Centum\Tests\Mvc\Controller\HttpMethodController;
use Centum\Tests\Mvc\Controller\IndexController;
use Centum\Tests\Mvc\Controller\MiddlewareController;
use Centum\Tests\Mvc\Controller\RequirementsController;
use Centum\Tests\UnitTester;
use Codeception\Example;

class RouterCest
{
    public function getRouteCollection(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $router = new Router($resolver, $routeCollection);

        $I->assertEquals(
            $routeCollection,
            $router->getRouteCollection()
        );
    }

    public function converters(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            ConverterController::class
        );



        $router = new Router($resolver, $routeCollection);

        $match = $router->handle("/converter/double/123", "GET");

        $I->assertEquals(
            246,
            $match->getParams()->get("i")
        );
    }

    /**
     * @dataProvider middlewaresProvider
     */
    public function middlewares(UnitTester $I, Example $example)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            MiddlewareController::class
        );



        $router = new Router($resolver, $routeCollection);



        try {
            $match = $router->handle($example["url"], "GET");

            $I->assertTrue($example["shouldPass"]);
        } catch (RouteNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    public function middlewaresProvider() : array
    {
        return [
            [
                "url"        => "/middleware/true",
                "shouldPass" => true,
            ],

            [
                "url"        => "/middleware/false",
                "shouldPass" => false,
            ],

            [
                "url"        => "/middleware/true-false",
                "shouldPass" => false,
            ],

            [
                "url"        => "/middleware/false-true",
                "shouldPass" => false,
            ],
        ];
    }

    /**
     * @dataProvider requirementsProvider
     */
    public function requirements(UnitTester $I, Example $example)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            RequirementsController::class
        );



        $router = new Router($resolver, $routeCollection);



        try {
            $match = $router->handle($example["url"], "GET");

            $I->assertTrue($example["shouldPass"]);
        } catch (RouteNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    public function requirementsProvider()
    {
        return [
            [
                "url"        => "/requirements/123",
                "shouldPass" => true,
            ],

            [
                "url"        => "/requirements/hello",
                "shouldPass" => false,
            ],

            [
                "url"        => "/requirements/123.456",
                "shouldPass" => false,
            ],
        ];
    }

    public function routeNotFoundException(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $router = new Router($resolver, $routeCollection);



        $I->expectThrowable(
            RouteNotFoundException::class,
            function () use ($router) {
                $router->handle("/this/is/a/route/that/doesnt/exist", "GET");
            }
        );
    }

    public function httpMethods(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $routeCollection->addController(
            HttpMethodController::class
        );



        $router = new Router($resolver, $routeCollection);



        $getRouterMatch = $router->handle("/", "GET");

        $I->assertEquals(
            "get",
            $getRouterMatch->getPath()->getAction()
        );



        $postRouterMatch = $router->handle("/", "POST");

        $I->assertEquals(
            "post",
            $postRouterMatch->getPath()->getAction()
        );
    }

    public function getRoutes(UnitTester $I)
    {
        $container = new Container();

        $resolver = new Resolver($container);



        $routeCollection = new RouteCollection();



        $router = new Router($resolver, $routeCollection);


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
            RequirementsController::class
        );

        $I->assertCount(
            2,
            $routeCollection->getRoutes()
        );



        $routes = $routeCollection->getRoutes();

        foreach ($routes as $route) {
            $I->assertInstanceOf(
                Route::class,
                $route
            );
        }
    }
}
