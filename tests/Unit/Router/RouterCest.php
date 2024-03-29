<?php

namespace Tests\Unit\Router;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Middleware\FalseMiddleware;
use Centum\Router\Middleware\TrueMiddleware;
use Centum\Router\Router;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\Controllers\ExceptionController;
use Tests\Support\Controllers\ExceptionHandler;
use Tests\Support\Controllers\HttpMethodController;
use Tests\Support\Controllers\IndexController;
use Tests\Support\Controllers\LoginController;
use Tests\Support\Controllers\MiddlewareController;
use Tests\Support\Controllers\PostController;
use Tests\Support\Controllers\ReplacementController;
use Tests\Support\Controllers\RequirementsController;
use Tests\Support\Controllers\RouteNotFoundExceptionHandler;
use Tests\Support\Router\Replacements\DoublerReplacement;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Router
 */
final class RouterCest
{
    protected function getRouter(ContainerInterface $container): Router
    {
        $router = new Router($container);



        $router->addReplacement(
            new DoublerReplacement()
        );



        $group = $router->group();

        $group->get("/", IndexController::class, "index");

        $group->get("/exception", ExceptionController::class, "index");

        $group->get("/login", LoginController::class, "form");

        $group->get(
            "/requirements/{id:int}",
            RequirementsController::class,
            "required"
        );

        $group->crud("/posts", PostController::class);

        $group->get("/http-method", HttpMethodController::class, "get");
        $group->post("/http-method", HttpMethodController::class, "post");
        $group->head("/http-method", HttpMethodController::class, "head");
        $group->put("/http-method", HttpMethodController::class, "put");
        $group->delete("/http-method", HttpMethodController::class, "delete");
        $group->trace("/http-method", HttpMethodController::class, "trace");
        $group->options("/http-method", HttpMethodController::class, "options");
        $group->connect("/http-method", HttpMethodController::class, "connect");
        $group->patch("/http-method", HttpMethodController::class, "patch");

        $group->submission("/submission", LoginController::class);

        $group->get("/replacements/integer/{i:int}", ReplacementController::class, "integer");
        $group->get("/replacements/char/{i:char}", ReplacementController::class, "char");
        $group->get("/replacements/doubler/{i:doubler}", ReplacementController::class, "doubler");



        $trueGroup = $router->group(
            new TrueMiddleware()
        );

        $trueGroup->get("/middleware/true", MiddlewareController::class, "index");



        $falseGroup = $router->group(
            new FalseMiddleware()
        );

        $falseGroup->get("/middleware/false", MiddlewareController::class, "index");



        return $router;
    }



    public function testBasicHandle(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        $request = new Request("/", Method::GET);

        $response = $router->handle($request);

        $I->assertEquals(
            "homepage",
            $response->getContent()
        );
    }

    public function testBasicHandleWithTrailingSlash(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        $request = new Request("/login/", Method::GET);

        $response = $router->handle($request);

        $I->assertEquals(
            "login form",
            $response->getContent()
        );
    }

    #[DataProvider("providerReplacementsGood")]
    public function testReplacementsGood(UnitTester $I, Example $example): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $uri = $example["uri"];

        /** @var string */
        $expected = $example["expected"];

        $request = new Request(
            $uri,
            Method::GET
        );

        $response = $router->handle($request);

        $I->assertEquals(
            $expected,
            $response->getContent()
        );
    }

    protected function providerReplacementsGood(): array
    {
        return [
            [
                "uri"      => "/replacements/integer/123",
                "expected" => "i:123;",
            ],

            [
                "uri"      => "/replacements/char/a",
                "expected" => "s:1:\"a\";",
            ],

            [
                "uri"      => "/replacements/doubler/123",
                "expected" => "i:246;",
            ],
        ];
    }



    #[DataProvider("providerReplacementsBad")]
    public function testReplacementsBad(UnitTester $I, Example $example): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $uri = $example[0];

        $request = new Request(
            $uri,
            Method::GET
        );

        $I->expectThrowable(
            RouteNotFoundException::class,
            function () use ($router, $request) {
                $router->handle($request);
            }
        );
    }

    protected function providerReplacementsBad(): array
    {
        return [
            ["/replacements/integer/abc"],
            ["/replacements/integer/123.456"],
            ["/replacements/char/abc"],
            ["/replacements/doubler/abc"],
        ];
    }



    #[DataProvider("providerMiddlewares")]
    public function testMiddlewares(UnitTester $I, Example $example): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $url = $example["url"];

        try {
            $request = new Request($url, Method::GET);

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
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $url = $example["url"];

        $request = new Request($url, Method::GET);

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
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var Method */
        $method = $example["method"];

        $request = new Request("/http-method", $method);

        $response = $router->handle($request);

        $I->assertEquals(
            $method->value,
            $response->getContent()
        );
    }

    protected function providerHttpMethods(): array
    {
        $methods = [
            Method::GET,
            Method::POST,
            Method::HEAD,
            Method::PUT,
            Method::DELETE,
            Method::TRACE,
            Method::OPTIONS,
            Method::CONNECT,
            Method::PATCH,
        ];

        return array_map(
            function (mixed $value): array {
                return [
                    "method" => $value,
                ];
            },
            $methods
        );
    }



    public function testRouteNotFoundException(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        $request = new Request(
            "/this/route/does/not/exist",
            Method::GET
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
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $uri = $example["uri"];

        /** @var Method */
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
                "method"  => Method::GET,
                "content" => "index",
            ],

            [
                "uri"     => "/posts/create",
                "method"  => Method::GET,
                "content" => "create",
            ],

            [
                "uri"     => "/posts",
                "method"  => Method::POST,
                "content" => "store",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => Method::GET,
                "content" => "show",
            ],

            [
                "uri"     => "/posts/123/edit",
                "method"  => Method::GET,
                "content" => "edit",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => Method::PUT,
                "content" => "update",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => Method::PATCH,
                "content" => "update",
            ],

            [
                "uri"     => "/posts/123",
                "method"  => Method::DELETE,
                "content" => "destroy",
            ],
        ];
    }



    #[DataProvider("providerSubmission")]
    public function testSubmission(UnitTester $I, Example $example): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        /** @var string */
        $uri = $example["uri"];

        /** @var Method */
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
                "uri"     => "/submission",
                "method"  => Method::GET,
                "content" => "login form",
            ],

            [
                "uri"     => "/submission",
                "method"  => Method::POST,
                "content" => "login successful",
            ],
        ];
    }



    public function testExceptionHandlers(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = $this->getRouter($container);



        $router->addExceptionHandler(
            RouteNotFoundExceptionHandler::class
        );

        $router->addExceptionHandler(
            ExceptionHandler::class
        );



        $request = new Request("/exception", Method::GET);

        $response = $router->handle($request);

        $I->assertEquals(
            "Internal server error",
            $response->getContent()
        );



        $request = new Request("/does-not-exist", Method::GET);

        $response = $router->handle($request);

        $I->assertEquals(
            "Page not found",
            $response->getContent()
        );
    }
}
