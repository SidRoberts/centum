<?php

namespace Centum\Mvc\Router\Route;

use Attribute;
use InvalidArgumentException;
use Centum\Mvc\MiddlewareInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Middleware
{
    protected string $middleware;



    public function __construct(string $middleware)
    {
        if (!is_subclass_of($middleware, MiddlewareInterface::class)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Middleware must implement %s",
                    MiddlewareInterface::class
                )
            );
        }

        $this->middleware = $middleware;
    }



    public function getMiddleware() : string
    {
        return $this->middleware;
    }
}
