<?php

namespace Centum\Tests\Mvc\Router\Route;

use InvalidArgumentException;
use Centum\Mvc\Router;
use Centum\Mvc\Router\Route\Middlewares;
use Centum\Tests\UnitTester;

class MiddlewaresCest
{
    public function badMiddleware(UnitTester $I)
    {
        $I->expectThrowable(
            InvalidArgumentException::class,
            function () {
                $middlewares = new Middlewares(
                    [
                        Router::class,
                    ]
                );
            }
        );
    }
}
