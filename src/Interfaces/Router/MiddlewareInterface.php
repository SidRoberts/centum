<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;

interface MiddlewareInterface
{
    public function middleware(RequestInterface $request, ContainerInterface $container): bool;
}
