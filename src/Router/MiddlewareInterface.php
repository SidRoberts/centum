<?php

namespace Centum\Router;

use Centum\Container\Container;
use Centum\Http\Request;

interface MiddlewareInterface
{
    public function middleware(Request $request, Container $container): bool;
}
