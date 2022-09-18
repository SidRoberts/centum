<?php

namespace Tests\Unit\Router;

use Centum\Router\Route;
use Tests\Support\Controllers\IndexController;
use Tests\Support\UnitTester;

class RouteCest
{
    public function testBasicGetters(UnitTester $I): void
    {
        $httpMethod = "GET";
        $uri        = "/";
        $class      = IndexController::class;
        $method     = "index";

        $route = new Route($httpMethod, $uri, $class, $method);

        $I->assertEquals(
            $httpMethod,
            $route->getHttpMethod()
        );

        $I->assertEquals(
            $uri,
            $route->getUri()
        );

        $I->assertEquals(
            $class,
            $route->getClass()
        );

        $I->assertEquals(
            $method,
            $route->getMethod()
        );
    }
}
