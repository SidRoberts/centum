<?php

namespace Centum\Interfaces\Console;

use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

interface CommandInterface
{
    public function getName(): string;

    public function getDescription(): string;

    public function getHelp(): string;



    public function getMiddleware(): MiddlewareInterface;

    public function getFilters(ContainerInterface $container): array;



    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int;
}
