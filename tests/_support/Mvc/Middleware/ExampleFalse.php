<?php

namespace Centum\Tests\Mvc\Middleware;

use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Router\Route;

class ExampleFalse implements MiddlewareInterface
{
    public function middleware(string $uri, Route $route) : bool
    {
        return false;
    }
}
