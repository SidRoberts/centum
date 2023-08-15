<?php

namespace Centum\Router\Middleware;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class TrueMiddleware implements MiddlewareInterface
{
    public function middleware(RequestInterface $request): bool
    {
        return true;
    }
}
