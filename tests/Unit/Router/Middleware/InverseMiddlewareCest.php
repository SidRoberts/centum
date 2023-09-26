<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Router\Middleware\FalseMiddleware;
use Centum\Router\Middleware\InverseMiddleware;
use Centum\Router\Middleware\TrueMiddleware;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Middleware\InverseMiddleware
 */
final class InverseMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request = new Request("/", Method::GET);



        $middleware = new InverseMiddleware(
            new TrueMiddleware()
        );

        $I->assertFalse(
            $middleware->check($request)
        );



        $middleware = new InverseMiddleware(
            new FalseMiddleware()
        );

        $I->assertTrue(
            $middleware->check($request)
        );
    }
}
