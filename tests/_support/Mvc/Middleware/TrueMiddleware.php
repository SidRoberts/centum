<?php

namespace Tests\Mvc\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Route;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, Route $route, Container $container): bool
    {
        return true;
    }
}
