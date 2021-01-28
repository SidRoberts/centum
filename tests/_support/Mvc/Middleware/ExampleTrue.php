<?php

namespace Centum\Tests\Mvc\Middleware;

use Centum\Container\Container;
use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Route;
use Centum\Http\Request;

class ExampleTrue implements MiddlewareInterface
{
    public function middleware(Request $request, Route $route, Container $container) : bool
    {
        return true;
    }
}
