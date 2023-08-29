<?php

namespace Tests\Unit\Router;

use Centum\Router\Group;
use Centum\Router\Middleware\TrueMiddleware;
use Tests\Support\Controllers\IndexController;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Group
 */
class GroupCest
{
    public function testGetMiddleware(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $I->assertSame(
            $middleware,
            $group->getMiddleware()
        );
    }

    public function testGetRoutes(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route1 = $group->get("/uri", IndexController::class, "index");
        $route2 = $group->post("/uri", IndexController::class, "index");

        $I->assertSame(
            [
                $route1,
                $route2,
            ],
            $group->getRoutes()
        );
    }

    public function testGet(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->get("/uri", IndexController::class, "index");

        $I->assertEquals(
            "GET",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testPost(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->post("/uri", IndexController::class, "index");

        $I->assertEquals(
            "POST",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testHead(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->head("/uri", IndexController::class, "index");

        $I->assertEquals(
            "HEAD",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testPut(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->put("/uri", IndexController::class, "index");

        $I->assertEquals(
            "PUT",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testDelete(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->delete("/uri", IndexController::class, "index");

        $I->assertEquals(
            "DELETE",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testTrace(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->trace("/uri", IndexController::class, "index");

        $I->assertEquals(
            "TRACE",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testOptions(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->options("/uri", IndexController::class, "index");

        $I->assertEquals(
            "OPTIONS",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testConnect(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->connect("/uri", IndexController::class, "index");

        $I->assertEquals(
            "CONNECT",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testPatch(UnitTester $I): void
    {
        $middleware = new TrueMiddleware();

        $group = new Group($middleware);

        $route = $group->patch("/uri", IndexController::class, "index");

        $I->assertEquals(
            "PATCH",
            $route->getHttpMethod()
        );

        $I->assertSame(
            [
                $route,
            ],
            $group->getRoutes()
        );
    }

    public function testCrud(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testSubmission(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }
}
