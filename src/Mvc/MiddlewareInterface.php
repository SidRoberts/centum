<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\Route;

interface MiddlewareInterface
{
    public function middleware(Request $request, Route $route, Container $container) : bool;
}
