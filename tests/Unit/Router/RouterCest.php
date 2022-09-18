<?php

namespace Tests\Unit\Router;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\FalseMiddleware;
use Centum\Router\Middleware\TrueMiddleware;
use Centum\Router\Router;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Tests\Support\Controllers\ExceptionController;
use Tests\Support\Controllers\FilterController;
use Tests\Support\Controllers\HttpMethodController;
use Tests\Support\Controllers\IndexController;
use Tests\Support\Controllers\LoginController;
use Tests\Support\Controllers\MiddlewareController;
use Tests\Support\Controllers\PostController;
use Tests\Support\Controllers\RequirementsController;
use Tests\Support\Filters\Doubler;
use Tests\Support\UnitTester;

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

    public function testBasicHandleWithTrailingSlash(UnitTester $I): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->get("/login", LoginController::class, "form");



        $request = new Request("/login/", "GET");

        $response = $router->handle($request);

        $I->assertEquals(
            "login form",
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



    #[DataProvider("providerMiddlewares")]
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



        /** @var string */
        $url = $example["url"];

        try {
            $request = new Request($url, "GET");

            $router->handle($request);

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



    #[DataProvider("providerRequirements")]
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



        /** @var string */
        $url = $example["url"];

        $request = new Request($url, "GET");

        try {
            $router->handle($request);

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



    #[DataProvider("providerHttpMethods")]
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



        /** @var string */
        $method = $example["method"];



        $request = new Request("/", $method);

        $response = $router->handle($request);

        $I->assertEquals(
            $method,
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
            function () use ($router, $request): void {
                $router->handle($request);
            }
        );
    }



    #[DataProvider("providerCrud")]
    public function testCrud(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->crud("/posts", PostController::class);



        /** @var string */
        $uri = $example["uri"];

        /** @var string */
        $method = $example["method"];

        $request = new Request($uri, $method);



        /** @var string */
        $content = $example["content"];

        $response = $router->handle($request);

        $I->assertEquals(
            $content,
            $response->getContent()
        );
    }

    protected function providerCrud(): array
    {
        return [
            [
                "uri"     => "/posts",
                "method"  => "GET",
                "content" => "index",
            ],

            [
                "uri"     => "/posts/create",
                "method"  => "GET",
                "content" => "create",
            ],

            [
                "uri"     => "/posts",
                "method"  => "POST",
                "content" => "store",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => "GET",
                "content" => "show",
            ],

            [
                "uri"     => "/posts/123/edit",
                "method"  => "GET",
                "content" => "edit",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => "PUT",
                "content" => "update",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => "PATCH",
                "content" => "update",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => "DELETE",
                "content" => "destroy",
            ],
        ];
    }



    #[DataProvider("providerSubmission")]
    public function testSubmission(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $router = new Router($container);



        $group = $router->group();

        $group->submission("/login", LoginController::class);



        /** @var string */
        $uri = $example["uri"];

        /** @var string */
        $method = $example["method"];

        $request = new Request($uri, $method);

        $response = $router->handle($request);

        /** @var string */
        $content = $example["content"];

        $I->assertEquals(
            $content,
            $response->getContent()
        );
    }

    protected function providerSubmission(): array
    {
        return [
            [
                "uri"     => "/login",
                "method"  => "GET",
                "content" => "login form",
            ],

            [
                "uri"     => "/login",
                "method"  => "POST",
                "content" => "login successful",
            ],
        ];
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
