<?php

namespace Centum\Router\Middleware;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(RequestInterface $request, ContainerInterface $container): bool
    {
        return true;
    }
}
