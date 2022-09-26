<?php

namespace Centum\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

abstract class Command
{
    abstract public function getName(): string;

    public function getDescription(): string
    {
        return "";
    }

    public function getHelp(): string
    {
        return "";
    }



    public function getMiddleware(): MiddlewareInterface
    {
        return new TrueMiddleware();
    }

    public function getFilters(ContainerInterface $container): array
    {
        return [];
    }



    abstract public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int;
}
