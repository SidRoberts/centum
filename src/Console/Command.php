<?php

namespace Centum\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Container\Container;

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

    public function getFilters(Container $container): array
    {
        return [];
    }



    abstract public function execute(Terminal $terminal, Container $container, Parameters $parameters): int;
}
