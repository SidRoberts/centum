<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Router\Middleware\FalseMiddleware;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Middleware\FalseMiddleware
 */
final class FalseMiddlewareCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $middleware = $I->mock(FalseMiddleware::class);

        $I->assertInstanceOf(MiddlewareInterface::class, $middleware);
    }



    public function test(UnitTester $I): void
    {
        $request = new Request("/", Method::GET);

        $middleware = new FalseMiddleware();

        $I->assertFalse(
            $middleware->check($request)
        );
    }
}
