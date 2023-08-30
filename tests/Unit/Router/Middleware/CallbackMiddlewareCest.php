<?php

namespace Tests\Unit\Router\Middleware;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Router\Middleware\CallbackMiddleware;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Middleware\CallbackMiddleware
 */
class CallbackMiddlewareCest
{
    public function test(UnitTester $I): void
    {
        $request = new Request("/", Method::GET);



        $middleware = new CallbackMiddleware(
            /** @psalm-suppress UnusedClosureParam */
            function (RequestInterface $request): bool {
                return true;
            }
        );

        $I->assertTrue(
            $middleware->check($request)
        );



        $middleware = new CallbackMiddleware(
            /** @psalm-suppress UnusedClosureParam */
            function (RequestInterface $request): bool {
                return false;
            }
        );

        $I->assertFalse(
            $middleware->check($request)
        );
    }
}
