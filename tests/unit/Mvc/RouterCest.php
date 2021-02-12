<?php

namespace Centum\Tests\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Router;
use Centum\Mvc\Exception\RouteNotFoundException;
use Centum\Mvc\Route;
use Centum\Tests\Mvc\Route\ConverterRoute;
use Centum\Tests\Mvc\Route\IndexRoute;
use Centum\Tests\Mvc\Route\HttpMethodRoute;
use Centum\Tests\Mvc\Route\Middleware\TrueRoute;
use Centum\Tests\Mvc\Route\Middleware\FalseRoute;
use Centum\Tests\Mvc\Route\Middleware\Multiple1Route;
use Centum\Tests\Mvc\Route\Middleware\Multiple2Route;
use Centum\Tests\Mvc\Route\RequirementsRoute;
use Centum\Tests\UnitTester;
use Codeception\Example;

class RouterCest
{
    public function basicHandle(UnitTester $I)
    {
        $container = new Container();

        $router = new Router($container);

        $router->addRoute(
            new IndexRoute()
        );



        $request = Request::create("/", "GET");

        $response = $router->handle($request);

        $I->assertEquals(
            "homepage",
            $response->getContent()
        );
    }

    public function converters(UnitTester $I)
    {
        $container = new Container();

        $router = new Router($container);

        $router->addRoute(
            new ConverterRoute()
        );



        $request = Request::create(
            "/converter/double/123",
            "GET"
        );

        $response = $router->handle($request);

        $I->assertEquals(
            246,
            $response->getContent()
        );
    }

    /**
     * @dataProvider middlewaresProvider
     */
    public function middlewares(UnitTester $I, Example $example)
    {
        $container = new Container();

        $router = new Router($container);

        $router->addRoute(
            new TrueRoute()
        );

        $router->addRoute(
            new FalseRoute()
        );

        $router->addRoute(
            new Multiple1Route()
        );

        $router->addRoute(
            new Multiple2Route()
        );



        try {
            $request = Request::create(
                $example["url"],
                "GET"
            );

            $response = $router->handle($request);

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

        $router = new Router($container);

        $router->addRoute(
            new RequirementsRoute()
        );



        $request = Request::create(
            $example["url"],
            "GET"
        );

        try {
            $response = $router->handle($request);

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

    /**
     * @dataProvider httpMethodsProvider
     */
    public function httpMethods(UnitTester $I, Example $example)
    {
        $container = new Container();

        $router = new Router($container);

        $router->addRoute(
            new HttpMethodRoute()
        );



        $request = Request::create(
            "/",
            $example["method"]
        );

        $response = $router->handle($request);

        $I->assertEquals(
            $example["method"],
            $response->getContent()
        );
    }

    public function httpMethodsProvider()
    {
        return [
            [
                "method" => "GET",
            ],

            [
                "method" => "POST",
            ],
        ];
    }

    public function routeNotFoundException(UnitTester $I)
    {
        $container = new Container();

        $router = new Router($container);

        $request = Request::create(
            "/this/route/does/not/exist",
            "GET"
        );

        $I->expectThrowable(
            RouteNotFoundException::class,
            function () use ($request, $router) {
                $response = $router->handle($request);
            }
        );
    }
}
