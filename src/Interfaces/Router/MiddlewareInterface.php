<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;

interface MiddlewareInterface
{
    /**
     * Returns `true` if the middleware accepts the Request or `false` if it
     * doesn't.
     */
    public function check(RequestInterface $request): bool;
}
