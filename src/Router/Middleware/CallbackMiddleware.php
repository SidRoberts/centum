<?php

namespace Centum\Router\Middleware;

use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class CallbackMiddleware implements MiddlewareInterface
{
    /**
     * @param (callable(RequestInterface): bool) $callable
     */
    public function __construct(
        protected $callable
    ) {
    }

    public function check(RequestInterface $request): bool
    {
        return ($this->callable)($request);
    }
}
