<?php

namespace Centum\Router\Middleware;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class InverseMiddleware implements MiddlewareInterface
{
    public function __construct(
        protected readonly MiddlewareInterface $middleware
    ) {
    }

    public function check(RequestInterface $request): bool
    {
        return !$this->middleware->check($request);
    }
}
