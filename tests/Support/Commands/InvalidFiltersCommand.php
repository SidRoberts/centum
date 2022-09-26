<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class InvalidFiltersCommand extends Command
{
    public function getName(): string
    {
        return "invalid-filters";
    }

    public function getFilters(ContainerInterface $container): array
    {
        return [
            "a" => new Terminal(),
            "b" => new Container(),
        ];
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
