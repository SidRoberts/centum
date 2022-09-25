<?php

namespace Centum\Router\Middleware;

use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Router\MiddlewareInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, ContainerInterface $container): bool
    {
        return true;
    }
}
