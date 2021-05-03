<?php

namespace Tests\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class InvalidFiltersCommand extends Command
{
    public function getName(): string
    {
        return "invalid-filters";
    }

    public function getFilters(Container $container): array
    {
        return [
            "a" => new Terminal(),
            "b" => new Container(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        return 0;
    }
}
