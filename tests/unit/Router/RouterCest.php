<?php

namespace Tests\Unit\Router;

use Centum\Container\Container;
use Centum\Forms\FormFactory;
use Centum\Http\Request;
use Centum\Router\Exception\FormRequestException;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\FalseMiddleware;
use Centum\Router\Middleware\TrueMiddleware;
use Centum\Router\Router;
use Codeception\Example;
use Exception;
use Tests\Controllers\ExceptionController;
use Tests\Controllers\FilterController;
use Tests\Controllers\HttpMethodController;
use Tests\Controllers\IndexController;
use Tests\Controllers\LoginController;
use Tests\Controllers\MiddlewareController;
use Tests\Controllers\PostController;
use Tests\Controllers\RequirementsController;
use Tests\Filters\Doubler;
use Tests\Forms\LoginTemplate;
use Tests\UnitTester;

class RouterCest
{
    public function testBasicHandle(UnitTester $I): void
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

    public function testFilters(UnitTester $I): void
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
     * @dataProvider providerMiddlewares
     */
    public function testMiddlewares(UnitTester $I, Example $example): void
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

    protected function providerMiddlewares(): array
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
     * @dataProvider providerRequirements
     */
    public function testRequirements(UnitTester $I, Example $example): void
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

    protected function providerRequirements(): array
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
     * @dataProvider providerHttpMethods
     */
    public function testHttpMethods(UnitTester $I, Example $example): void
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

    protected function providerHttpMethods(): array
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

    public function testRouteNotFoundException(UnitTester $I): void
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

    public function testCrud(UnitTester $I): void
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

    public function testSubmission(UnitTester $I): void
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

    public function testFormRequests(UnitTester $I): void
    {
        $template = new LoginTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



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

    public function testExceptionHandlers(UnitTester $I): void
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
