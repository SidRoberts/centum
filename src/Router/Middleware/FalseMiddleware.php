<?php

namespace Centum\Router\Middleware;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class FalseMiddleware implements MiddlewareInterface
{
    public function check(RequestInterface $request): bool
    {
        return false;
    }
}
