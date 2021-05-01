<?php

namespace Tests\Unit\Mvc\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\Middleware\TrueMiddleware;
use Tests\UnitTester;

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
