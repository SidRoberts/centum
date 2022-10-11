<?php

namespace Centum\Console;

use Centum\Console\Middleware\TrueMiddleware;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Filter\FilterInterface;

abstract class Command implements CommandInterface
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

    /**
     * @return array<string, FilterInterface>
     */
    public function getFilters(ContainerInterface $container): array
    {
        return [];
    }



    abstract public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int;
}
