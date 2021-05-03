<?php

namespace Centum\Router\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Router\MiddlewareInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, Container $container): bool
    {
        return true;
    }
}