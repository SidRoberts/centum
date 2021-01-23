<?php

namespace Centum\Mvc\Middleware;

use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Router\Route;

class Runner
{
    protected array $middlewares = [];



    public function getMiddlewares() : array
    {
        return $this->middlewares;
    }

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }



    public function run(string $uri, Route $route) : bool
    {
        foreach ($this->middlewares as $middleware) {
            $success = $middleware->middleware($uri, $route);

            if (!$success) {
                return false;
            }
        }

        return true;
    }
}
