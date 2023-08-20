<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Request;
use Centum\Router\Middleware\TrueMiddleware;
use Tests\Support\UnitTester;

class TrueMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request = new Request("/", "GET");

        $middleware = new TrueMiddleware();

        $I->assertTrue(
            $middleware->check($request)
        );
    }
}
