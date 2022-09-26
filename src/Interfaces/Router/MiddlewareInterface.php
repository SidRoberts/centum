<?php

namespace Centum\Interfaces\Router;

use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;

interface MiddlewareInterface
{
    public function middleware(Request $request, ContainerInterface $container): bool;
}
