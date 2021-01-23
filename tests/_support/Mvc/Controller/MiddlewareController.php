<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Middlewares;
use Centum\Mvc\Router\Route\Uri;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;

class MiddlewareController extends Controller
{
    #[
    Uri("/middleware/true"),
    Middlewares(
        [
            ExampleTrue::class,
        ]
    )
    ]
    public function true()
    {
    }

    #[
    Uri("/middleware/false"),
    Middlewares(
        [
            ExampleFalse::class,
        ]
    )
    ]
    public function false()
    {
    }

    #[
    Uri("/middleware/true-false"),
    Middlewares(
        [
            ExampleTrue::class,
            ExampleFalse::class,
        ]
    )
    ]
    public function multiple1()
    {
    }

    #[
    Uri("/middleware/false-true"),
    Middlewares(
        [
            ExampleFalse::class,
            ExampleTrue::class,
        ]
    )
    ]
    public function multiple2()
    {
    }
}
