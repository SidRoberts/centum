<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Router\Middleware\TrueMiddleware;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Middleware\TrueMiddleware
 */
final class TrueMiddlewareCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $middleware = $I->mock(TrueMiddleware::class);

        $I->assertInstanceOf(MiddlewareInterface::class, $middleware);
    }



    public function test(UnitTester $I): void
    {
        $request = new Request("/", Method::GET);

        $middleware = new TrueMiddleware();

        $I->assertTrue(
            $middleware->check($request)
        );
    }
}
