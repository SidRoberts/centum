<?php

namespace Centum\Mvc\Middleware;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\MiddlewareInterface;

class FalseMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, Container $container): bool
    {
        return false;
    }
}
