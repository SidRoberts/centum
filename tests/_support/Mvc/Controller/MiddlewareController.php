<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Middleware;
use Centum\Mvc\Router\Route\Uri;
use Centum\Tests\Mvc\Middleware\ExampleTrue;
use Centum\Tests\Mvc\Middleware\ExampleFalse;

class MiddlewareController extends Controller
{
    #[Uri("/middleware/true")]
    #[Middleware(ExampleTrue::class)]
    public function true()
    {
    }

    #[Uri("/middleware/false")]
    #[Middleware(ExampleFalse::class)]
    public function false()
    {
    }

    #[Uri("/middleware/true-false")]
    #[Middleware(ExampleTrue::class)]
    #[Middleware(ExampleFalse::class)]
    public function multiple1()
    {
    }

    #[Uri("/middleware/false-true")]
    #[Middleware(ExampleFalse::class)]
    #[Middleware(ExampleTrue::class)]
    public function multiple2()
    {
    }
}
