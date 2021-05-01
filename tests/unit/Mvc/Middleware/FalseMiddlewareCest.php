<?php

namespace Tests\Unit\Mvc\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\Middleware\FalseMiddleware;
use Tests\UnitTester;

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
