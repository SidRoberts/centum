<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Router\Middleware\FalseMiddleware;
use Tests\Support\UnitTester;

class FalseMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request   = new Request("/", "GET");
        $container = new Container();

        $middleware = new FalseMiddleware();

        $I->assertFalse(
            $middleware->middleware($request, $container)
        );
    }
}
