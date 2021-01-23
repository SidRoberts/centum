<?php

namespace Centum\Mvc\Router\Route;

use Attribute;
use InvalidArgumentException;
use Iterator;
use Centum\Mvc\MiddlewareInterface;

#[Attribute]
class Middlewares implements Iterator
{
    protected array $middlewares = [];



    public function __construct(array $middlewares)
    {
        foreach ($middlewares as $middleware) {
            if (!is_subclass_of($middleware, MiddlewareInterface::class)) {
                throw new InvalidArgumentException(
                    sprintf(
                        "Middleware must implement %s",
                        MiddlewareInterface::class
                    )
                );
            }

            $this->middlewares[] = $middleware;
        }
    }



    public function rewind()
    {
        reset($this->middlewares);
    }
  
    public function current()
    {
        return current($this->middlewares);
    }
  
    public function key()
    {
        return key($this->middlewares);
    }
  
    public function next()
    {
        return next($this->middlewares);
    }
  
    public function valid()
    {
        $key = key($this->middlewares);

        return ($key !== null && $key !== false);
    }
}
