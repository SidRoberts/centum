<?php

namespace Tests\Mvc;

use Centum\Container\Container;
use Centum\Forms\FormFactory;
use Centum\Http\Request;
use Centum\Mvc\Exception\FormRequestException;
use Centum\Mvc\Exception\RouteNotFoundException;
use Centum\Mvc\Group;
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
use Tests\Mvc\Controllers\PostController;
use Tests\Mvc\Controllers\RequirementsController;
use Tests\Mvc\Filter\Doubler;
use Tests\Mvc\Middleware\FalseMiddleware;
use Tests\Mvc\Middleware\TrueMiddleware;
use Tests\UnitTester;

class RouterCest
{
    public function basicHandle(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->get("/", IndexController::class, "index");



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



        $group = $router->group();

        $group->get("/filter/double/{i:int}", FilterController::class, "get")
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



        $trueGroup = $router->group(
            new TrueMiddleware()
        );

        $trueGroup->get("/middleware/true", MiddlewareController::class, "index");



        $falseGroup = $router->group(
            new FalseMiddleware()
        );

        $falseGroup->get("/middleware/false", MiddlewareController::class, "index");



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



        $group = $router->group();

        $group->get(
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

        $group = $router->group();

        $group->get("/", HttpMethodController::class, "get");
        $group->post("/", HttpMethodController::class, "post");
        $group->head("/", HttpMethodController::class, "head");
        $group->put("/", HttpMethodController::class, "put");
        $group->delete("/", HttpMethodController::class, "delete");
        $group->trace("/", HttpMethodController::class, "trace");
        $group->options("/", HttpMethodController::class, "options");
        $group->connect("/", HttpMethodController::class, "connect");
        $group->patch("/", HttpMethodController::class, "patch");



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

    public function crud(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->crud("/posts", PostController::class);



        $request  = new Request("/posts", "GET");
        $response = $router->handle($request);

        $I->assertEquals(
            "index",
            $response->getContent()
        );



        $request  = new Request("/posts/create", "GET");
        $response = $router->handle($request);

        $I->assertEquals(
            "create",
            $response->getContent()
        );



        $request  = new Request("/posts", "POST");
        $response = $router->handle($request);

        $I->assertEquals(
            "store",
            $response->getContent()
        );



        $request  = new Request("/posts/123", "GET");
        $response = $router->handle($request);

        $I->assertEquals(
            "show",
            $response->getContent()
        );



        $request  = new Request("/posts/123/edit", "GET");
        $response = $router->handle($request);

        $I->assertEquals(
            "edit",
            $response->getContent()
        );



        $request  = new Request("/posts/123", "PUT");
        $response = $router->handle($request);

        $I->assertEquals(
            "update",
            $response->getContent()
        );



        $request  = new Request("/posts/123", "PATCH");
        $response = $router->handle($request);

        $I->assertEquals(
            "update",
            $response->getContent()
        );



        $request  = new Request("/posts/123", "DELETE");
        $response = $router->handle($request);

        $I->assertEquals(
            "destroy",
            $response->getContent()
        );
    }

    public function submission(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->submission("/login", LoginController::class);



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

        $form = FormFactory::createFromTemplate($template);



        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->get("/login", LoginController::class, "form");

        $group->post("/login", LoginController::class, "submit", $form);



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



        $group = $router->group();

        $group->get("/", ExceptionController::class, "index");



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
