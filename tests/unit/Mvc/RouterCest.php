<?php

namespace Tests\Mvc;

use Centum\Container\Container;
use Centum\Forms\Factory as FormFactory;
use Centum\Http\Request;
use Centum\Mvc\Exception\FormRequestException;
use Centum\Mvc\Exception\RouteNotFoundException;
use Centum\Mvc\Router;
use Codeception\Example;
use Exception;
use Tests\Forms\LoginTemplate;
use Tests\Mvc\Controllers\ExceptionController;
use Tests\Mvc\Controllers\FilterController;
use Tests\Mvc\Controllers\HttpMethodController;
use Tests\Mvc\Controllers\IndexController;
use Tests\Mvc\Controllers\LoginController;
use Tests\Mvc\Controllers\MiddlewareController;
use Tests\Mvc\Controllers\RequirementsController;
use Tests\Mvc\Filter\Doubler;
use Tests\Mvc\Middleware\ExampleFalse;
use Tests\Mvc\Middleware\ExampleTrue;
use Tests\UnitTester;

class RouterCest
{
    public function basicHandle(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->get("/", IndexController::class, "index");



        $request = new Request("/", "GET");

        $response = $router->handle($request);

        $I->assertEquals(
            "homepage",
            $response->getContent()
        );
    }

    public function filters(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->get("/filter/double/{i:int}", FilterController::class, "get")
            ->addFilter("i", new Doubler());



        $request = new Request(
            "/filter/double/123",
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
    public function middlewares(UnitTester $I, Example $example): void
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
            $request = new Request(
                $example["url"],
                "GET"
            );

            $response = $router->handle($request);

            $I->assertTrue($example["shouldPass"]);
        } catch (RouteNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    public function middlewaresProvider(): array
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
    public function requirements(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->get(
            "/requirements/{id:int}",
            RequirementsController::class,
            "required"
        );



        $request = new Request(
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

    public function requirementsProvider(): array
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
    public function httpMethods(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->get("/", HttpMethodController::class, "get");
        $router->post("/", HttpMethodController::class, "post");
        $router->head("/", HttpMethodController::class, "head");
        $router->put("/", HttpMethodController::class, "put");
        $router->delete("/", HttpMethodController::class, "delete");
        $router->trace("/", HttpMethodController::class, "trace");
        $router->options("/", HttpMethodController::class, "options");
        $router->connect("/", HttpMethodController::class, "connect");
        $router->patch("/", HttpMethodController::class, "patch");



        $request = new Request(
            "/",
            $example["method"]
        );

        $response = $router->handle($request);

        $I->assertEquals(
            $example["method"],
            $response->getContent()
        );
    }

    public function httpMethodsProvider(): array
    {
        return [
            [
                "method" => "GET",
            ],

            [
                "method" => "POST",
            ],

            [
                "method" => "HEAD",
            ],

            [
                "method" => "PUT",
            ],

            [
                "method" => "DELETE",
            ],

            [
                "method" => "TRACE",
            ],

            [
                "method" => "OPTIONS",
            ],

            [
                "method" => "CONNECT",
            ],

            [
                "method" => "PATCH",
            ],
        ];
    }

    public function routeNotFoundException(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);

        $request = new Request(
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

    public function submission(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->submission("/login", LoginController::class);



        $getRequest = new Request("/login", "GET");

        $getResponse = $router->handle($getRequest);

        $I->assertEquals(
            "login form",
            $getResponse->getContent()
        );



        $postRequest = new Request("/login", "POST");

        $postResponse = $router->handle($postRequest);

        $I->assertEquals(
            "login successful",
            $postResponse->getContent()
        );
    }

    public function formRequests(UnitTester $I): void
    {
        $template = new LoginTemplate();

        $form = FormFactory::build($template);



        $container = new Container();

        $router = new Router($container);

        $router->get("/login", LoginController::class, "form");

        $router->post("/login", LoginController::class, "submit", $form);



        $request = new Request("/login", "POST");

        $I->expectThrowable(
            FormRequestException::class,
            function () use ($router, $request) {
                $response = $router->handle($request);
            }
        );



        $request = new Request(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $response = $router->handle($request);

        $I->assertEquals(
            "login successful",
            $response->getContent()
        );
    }

    public function exceptionHandlers(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);

        $router->get("/", ExceptionController::class, "index");

        $router->addExceptionHandler(
            RouteNotFoundException::class,
            ExceptionController::class,
            "pageNotFound"
        );

        $router->addExceptionHandler(
            Exception::class,
            ExceptionController::class,
            "internalServerError"
        );



        $request = new Request("/", "GET");

        $response = $router->handle($request);

        $I->assertEquals(
            "Internal server error",
            $response->getContent()
        );



        $request = new Request("/does-not-exist", "GET");

        $response = $router->handle($request);

        $I->assertEquals(
            "Page not found",
            $response->getContent()
        );
    }
}
