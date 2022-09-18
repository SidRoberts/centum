<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Router\Middleware\TrueMiddleware;
use Tests\Support\UnitTester;

class TrueMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request   = new Request("/", "GET");
        $container = new Container();

        $middleware = new TrueMiddleware();

        $I->assertTrue(
            $middleware->middleware($request, $container)
        );
    }
}
