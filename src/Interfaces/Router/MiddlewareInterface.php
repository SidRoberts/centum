<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Http\RequestInterface;

interface MiddlewareInterface
{
    public function check(RequestInterface $request): bool;
}
