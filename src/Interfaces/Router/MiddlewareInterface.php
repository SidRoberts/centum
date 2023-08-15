<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;

interface MiddlewareInterface
{
    public function middleware(RequestInterface $request): bool;
}
