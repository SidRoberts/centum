<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Filter\FilterInterface;

interface CommandInterface
{
    public function getName(): string;

    public function getDescription(): string;

    public function getHelp(): string;



    public function getMiddleware(): MiddlewareInterface;

    /**
     * @return array<string, FilterInterface>
     */
    public function getFilters(ContainerInterface $container): array;



    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int;
}
