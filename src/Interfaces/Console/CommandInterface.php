<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Filter\FilterInterface;

interface CommandInterface
{
    // Command completed successfully.
    public const SUCCESS = 0;

    // An error happened during the execution.
    public const FAILURE = 1;

    // Incorrect command usage (e.g. invalid options or missing arguments).
    public const INVALID = 2;



    public function getMiddleware(): MiddlewareInterface;

    /**
     * @return array<string, FilterInterface>
     */
    public function getFilters(ContainerInterface $container): array;



    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int;
}
