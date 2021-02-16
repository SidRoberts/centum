<?php

namespace Centum\Tests\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Router;
use Centum\Mvc\Exception\RouteNotFoundException;
use Centum\Tests\Mvc\Controllers\ConverterController;
use Centum\Tests\Mvc\Controllers\IndexController;
use Centum\Tests\Mvc\Controllers\HttpMethodController;
use Centum\Tests\Mvc\Controllers\MiddlewareController;
use Centum\Tests\Mvc\Controllers\RequirementsController;
use Centum\Tests\Mvc\Converter\Doubler;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;
use Centum\Tests\UnitTester;
use Codeception\Example;

class RouterCest
{
    public function basicHandle(UnitTester $I)
    {
        $container = new Container();

        $router = new Router($container);

        $router->get("/", IndexController::class, "index");



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

        $router->get("/converter/double/{i:int}", ConverterController::class, "get")
            ->addConverter("i", new Doubler());



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

        $router->get("/middleware/true", MiddlewareController::class, "index")
            ->addMiddleware(new ExampleTrue());

        $router->get("/middleware/false", MiddlewareController::class, "index")
            ->addMiddleware(new ExampleFalse());

        $router->get("/middleware/true-false", MiddlewareController::class, "index")
            ->addMiddleware(new ExampleTrue())
            ->addMiddleware(new ExampleFalse());

        $router->get("/middleware/false-true", MiddlewareController::class, "index")
            ->addMiddleware(new ExampleFalse())
            ->addMiddleware(new ExampleTrue());



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

        $router->get(
            "/requirements/{id:int}",
            RequirementsController::class,
            "required"
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

        $router->get("/", HttpMethodController::class, "get");
        $router->post("/", HttpMethodController::class, "post");



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
