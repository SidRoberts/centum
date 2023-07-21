<?php

namespace Tests\Unit\Router\Exception;

use Centum\Http\Request;
use Centum\Router\Exception\RouteNotFoundException;
use Tests\Support\UnitTester;

class RouteNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $request = new Request("/articles/random-title", "GET");

        $exception = new RouteNotFoundException($request);

        $I->assertEquals(
            "GET /articles/random-title",
            $exception->getMessage()
        );

        $I->assertSame(
            $request,
            $exception->getRequest()
        );
    }
}
