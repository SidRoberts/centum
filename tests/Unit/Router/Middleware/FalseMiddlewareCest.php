<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Request;
use Centum\Router\Middleware\FalseMiddleware;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Middleware\FalseMiddleware
 */
class FalseMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request = new Request("/", "GET");

        $middleware = new FalseMiddleware();

        $I->assertFalse(
            $middleware->check($request)
        );
    }
}
