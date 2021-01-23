<?php

namespace Centum\Mvc;

use Centum\Mvc\Router\Route;

interface MiddlewareInterface
{
    public function middleware(string $uri, Route $route) : bool;
}
