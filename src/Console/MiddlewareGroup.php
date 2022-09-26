<?php

namespace Centum\Console;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class MiddlewareGroup implements MiddlewareInterface
{
    /** @var array<MiddlewareInterface> */
    protected array $middlewares = [];



    /** @param array<MiddlewareInterface> $middlewares */
    public function __construct(array $middlewares = [])
    {
        foreach ($middlewares as $middleware) {
            $this->add($middleware);
        }
    }



    public function add(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }



    public function toArray(): array
    {
        return $this->middlewares;
    }


    public function middleware(Terminal $terminal, CommandInterface $command, ContainerInterface $container): bool
    {
        foreach ($this->middlewares as $middleware) {
            $success = $middleware->middleware($terminal, $command, $container);

            if (!$success) {
                return false;
            }
        }

        return true;
    }
}